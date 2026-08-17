#!/usr/bin/env bash
# Deploy Brighter BD Elements plugin to a remote WordPress site via SSH + git archive.
# v1.0 | 2026-05-18
#
# Usage (from repo root or anywhere):
#   ./scripts/deploy.sh
#   ./scripts/deploy.sh --dry-run
#
# Requires: git, ssh, tar (Git Bash on Windows is fine).

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
ENV_FILE="${SCRIPT_DIR}/deploy.env"

DRY_RUN_CLI=0
for arg in "$@"; do
  case "$arg" in
    --dry-run|-n) DRY_RUN_CLI=1 ;;
    -h|--help)
      echo "Usage: $0 [--dry-run]"
      echo "Config: ${ENV_FILE} (copy from deploy.env.example)"
      exit 0
      ;;
  esac
done

if [[ ! -f "${ENV_FILE}" ]]; then
  echo "Missing ${ENV_FILE}" >&2
  echo "Copy scripts/deploy.env.example to scripts/deploy.env and set SSH_HOST, SSH_USER, REMOTE_PLUGIN_PATH." >&2
  exit 1
fi

# shellcheck source=/dev/null
source "${ENV_FILE}"

: "${SSH_HOST:?Set SSH_HOST in deploy.env}"
: "${SSH_USER:?Set SSH_USER in deploy.env}"
: "${REMOTE_PLUGIN_PATH:?Set REMOTE_PLUGIN_PATH in deploy.env}"

SSH_PORT="${SSH_PORT:-22}"
DEPLOY_BRANCH="${DEPLOY_BRANCH:-master}"
DRY_RUN="${DRY_RUN:-0}"
REMOTE_BACKUP="${REMOTE_BACKUP:-0}"

if [[ "${DRY_RUN_CLI}" -eq 1 ]]; then
  DRY_RUN=1
fi

REMOTE_PLUGIN_PATH="${REMOTE_PLUGIN_PATH%/}"
SSH_TARGET="${SSH_USER}@${SSH_HOST}"
# BatchMode=yes requires key loaded in ssh-agent first (ssh-add). No password prompts.
SSH_OPTS=(-p "${SSH_PORT}" -o BatchMode=yes -o ConnectTimeout=15 -o IdentitiesOnly=yes)

run() {
  if [[ "${DRY_RUN}" == "1" ]]; then
    printf '[dry-run] '; printf '%q ' "$@"; printf '\n'
  else
    "$@"
  fi
}

remote() {
  run ssh "${SSH_OPTS[@]}" "${SSH_TARGET}" "$@"
}

echo "==> Repo: ${REPO_ROOT}"
echo "==> Branch: ${DEPLOY_BRANCH}"
echo "==> Remote: ${SSH_TARGET}:${REMOTE_PLUGIN_PATH}"

cd "${REPO_ROOT}"

echo "==> Fetching origin..."
run git fetch origin

REF="origin/${DEPLOY_BRANCH}"
if ! git rev-parse --verify --quiet "${REF}" >/dev/null; then
  echo "Ref not found: ${REF}" >&2
  exit 1
fi

echo "==> Deploying tracked files (git archive) — excludes .git, export-ignore paths (see .gitattributes)..."

# Safety guard: refuse to touch anything that is not clearly a WP plugin folder.
# Runs BEFORE any mkdir, so a misconfigured REMOTE_PLUGIN_PATH cannot create a
# phantom directory tree and then deploy into it.
case "${REMOTE_PLUGIN_PATH}" in
  */wp-content/plugins/?*) : ;;
  *)
    echo "Refusing to deploy to '${REMOTE_PLUGIN_PATH}' — path is not a directory under wp-content/plugins/." >&2
    echo "Set REMOTE_PLUGIN_PATH to the full plugin directory in deploy.env." >&2
    exit 1
    ;;
esac

REMOTE_PARENT="$(dirname "${REMOTE_PLUGIN_PATH}")"

if [[ "${DRY_RUN}" == "1" ]]; then
  echo "[dry-run] plan:"
  [[ "${REMOTE_BACKUP}" == "1" ]] && echo "[dry-run]   cp -a '${REMOTE_PLUGIN_PATH}' '${REMOTE_PLUGIN_PATH}.bak-<stamp>'"
  echo "[dry-run]   STAGE=\$(mktemp -d '${REMOTE_PARENT}/.bd-deploy-XXXXXXXX')"
  echo "[dry-run]   git archive --worktree-attributes '${REF}' | ssh ... 'tar -xf - -C \$STAGE'"
  echo "[dry-run]   verify \$STAGE/plugin.php exists and \$STAGE is non-empty"
  echo "[dry-run]   mv '${REMOTE_PLUGIN_PATH}' <retired>  &&  mv \$STAGE '${REMOTE_PLUGIN_PATH}'"
  exit 0
fi

if [[ "${REMOTE_BACKUP}" == "1" ]]; then
  STAMP="$(date +%Y%m%d-%H%M%S)"
  BACKUP_PATH="${REMOTE_PLUGIN_PATH}.bak-${STAMP}"
  echo "==> Remote backup: ${BACKUP_PATH}"
  remote "if [ -d '${REMOTE_PLUGIN_PATH}' ]; then cp -a '${REMOTE_PLUGIN_PATH}' '${BACKUP_PATH}'; fi"
fi

# Stage into a fresh mktemp -d beside the target, then swap. A dropped connection
# or a failed extraction now leaves the live plugin directory untouched, instead
# of wiping it first and losing the plugin if the transfer never completes.
# mktemp -d creates a fresh 0700 directory or fails — never reuses a path an
# attacker pre-created, which a predictable name plus `mkdir -p` would.
echo "==> Creating remote staging directory..."
STAGE_DIR="$(ssh "${SSH_OPTS[@]}" "${SSH_TARGET}" \
  "mkdir -p '${REMOTE_PARENT}' && mktemp -d '${REMOTE_PARENT}/.bd-deploy-XXXXXXXX'")"

if [[ -z "${STAGE_DIR}" ]]; then
  echo "Failed to create remote staging directory under ${REMOTE_PARENT}" >&2
  exit 1
fi
echo "    ${STAGE_DIR}"

# Any failure from here on must not leave staging litter on the server.
cleanup_stage() {
  ssh "${SSH_OPTS[@]}" "${SSH_TARGET}" "rm -rf -- '${STAGE_DIR}'" >/dev/null 2>&1 || true
}
trap cleanup_stage EXIT

echo "==> Extracting archive into staging..."
git archive --worktree-attributes "${REF}" | ssh "${SSH_OPTS[@]}" "${SSH_TARGET}" "tar -xf - -C '${STAGE_DIR}'"

# Positive proof the payload arrived intact before anything live is touched.
echo "==> Verifying staged payload..."
remote "test -s '${STAGE_DIR}/plugin.php'"

# Orphan-safe swap: the staged tree fully replaces the old one, so files deleted
# from the repo (renamed elements, old form-actions) do not survive as orphans
# and cause duplicate-class fatals.
echo "==> Swapping staged tree into place..."
RETIRED="${REMOTE_PLUGIN_PATH}.retired-$(date +%Y%m%d-%H%M%S)-$$"
remote "set -e
        if [ -e '${REMOTE_PLUGIN_PATH}' ]; then mv -- '${REMOTE_PLUGIN_PATH}' '${RETIRED}'; fi
        if mv -- '${STAGE_DIR}' '${REMOTE_PLUGIN_PATH}'; then
          rm -rf -- '${RETIRED}'
        else
          if [ -e '${RETIRED}' ]; then mv -- '${RETIRED}' '${REMOTE_PLUGIN_PATH}'; fi
          exit 1
        fi"

trap - EXIT

echo "==> Done. Plugin deployed to ${REMOTE_PLUGIN_PATH}"
echo "    Tip: reload Breakdance → Settings if elements do not appear."
