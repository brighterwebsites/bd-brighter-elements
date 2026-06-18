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
DEPLOY_BRANCH="${DEPLOY_BRANCH:-claude/breakdance-cpt-submissions-3qVD8}"
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

if [[ "${REMOTE_BACKUP}" == "1" ]]; then
  STAMP="$(date +%Y%m%d-%H%M%S)"
  BACKUP_PATH="${REMOTE_PLUGIN_PATH}.bak-${STAMP}"
  echo "==> Remote backup: ${BACKUP_PATH}"
  remote "if [ -d '${REMOTE_PLUGIN_PATH}' ]; then cp -a '${REMOTE_PLUGIN_PATH}' '${BACKUP_PATH}'; fi"
fi

echo "==> Ensuring remote plugin directory exists..."
remote "mkdir -p '${REMOTE_PLUGIN_PATH}'"

# Extract archive on server (replaces plugin files; keeps nothing extra from old deploys).
ARCHIVE_CMD="git -C '${REPO_ROOT}' archive --worktree-attributes '${REF}' | ssh ${SSH_OPTS[*]} '${SSH_TARGET}' \"tar -xf - -C '${REMOTE_PLUGIN_PATH}'\""

if [[ "${DRY_RUN}" == "1" ]]; then
  echo "[dry-run] ${ARCHIVE_CMD}"
  exit 0
fi

git archive --worktree-attributes "${REF}" | ssh "${SSH_OPTS[@]}" "${SSH_TARGET}" "tar -xf - -C '${REMOTE_PLUGIN_PATH}'"

echo "==> Done. Plugin deployed to ${REMOTE_PLUGIN_PATH}"
echo "    Tip: reload Breakdance → Settings if elements do not appear."
