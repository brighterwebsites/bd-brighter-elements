# Deploy via PuTTY plink + pscp + .ppk
# v1.2 | 2026-05-19
#
# Tip: Run Pageant, load your .ppk once per Windows session - then no repeated passphrase prompts.
#
# Usage: .\scripts\deploy-plink.ps1
#        .\scripts\deploy-plink.ps1 -DryRun

param([switch]$DryRun)

$ErrorActionPreference = "Stop"
$RepoRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$EnvFile = Join-Path $PSScriptRoot "deploy.env"

if (-not (Test-Path $EnvFile)) {
    Write-Error "Missing deploy.env - copy deploy.env.example and set PPK_PATH."
}

Get-Content $EnvFile | ForEach-Object {
    if ($_ -match '^\s*#' -or $_ -notmatch '=') { return }
    $n, $v = $_ -split '=', 2
    $n = $n.Trim()
    $v = $v.Trim().Trim('"')
    Set-Item -Path "Env:$n" -Value $v
}

$Plink = @(
    "${env:ProgramFiles}\PuTTY\plink.exe"
    "${env:ProgramFiles(x86)}\PuTTY\plink.exe"
) | Where-Object { Test-Path $_ } | Select-Object -First 1

$Pscp = @(
    "${env:ProgramFiles}\PuTTY\pscp.exe"
    "${env:ProgramFiles(x86)}\PuTTY\pscp.exe"
) | Where-Object { Test-Path $_ } | Select-Object -First 1

if (-not $Plink -or -not $Pscp) {
    Write-Error "plink.exe and pscp.exe required (install PuTTY)."
}

if (-not $env:PPK_PATH -or -not (Test-Path $env:PPK_PATH)) {
    Write-Error "Set PPK_PATH in scripts/deploy.env to your .ppk file."
}

# No host/user/port fallbacks: a deploy must never guess which server it is
# talking to. Every connection field comes from deploy.env or the run stops.
foreach ($required in @('SSH_HOST', 'SSH_USER', 'REMOTE_PLUGIN_PATH')) {
    if ([string]::IsNullOrWhiteSpace((Get-Item "Env:$required" -ErrorAction SilentlyContinue).Value)) {
        Write-Error "Set $required in scripts/deploy.env (copy from deploy.env.example)."
    }
}

$HostRaw = $env:SSH_HOST
$User = $env:SSH_USER
$Port = if ($env:SSH_PORT) { $env:SSH_PORT } else { "22" }
$Remote = ($env:REMOTE_PLUGIN_PATH).TrimEnd('/')
$Branch = if ($env:DEPLOY_BRANCH) { $env:DEPLOY_BRANCH } else { "master" }

# Safety guard, matching scripts/deploy.sh: refuse to deploy to anything that is
# not a named directory under wp-content/plugins/. Without this the remote block
# below runs rm -rf and chown -R against whatever path happens to be configured.
if ($Remote -notmatch '/wp-content/plugins/[^/]+$') {
    Write-Error "Refusing to deploy to '$Remote' - not a plugin directory under wp-content/plugins/. Fix REMOTE_PLUGIN_PATH in scripts/deploy.env."
}

# $Remote is interpolated into single-quoted POSIX shell words on the server.
# A quote or backslash in it would break out of that quoting.
if ($Remote.Contains("'") -or $Remote.Contains('\') -or $Remote.Contains("`n") -or $Remote.Contains("`r")) {
    Write-Error "REMOTE_PLUGIN_PATH contains a quote, backslash or newline - refusing to build a remote command from it."
}

$Target = "${User}@${HostRaw}"
$Ref = "origin/$Branch"
$LocalTar = Join-Path $env:TEMP ("bd-brighter-elements-" + [System.IO.Path]::GetRandomFileName() + ".tar")

# -batch = no "Press Return to begin session"; run remote command non-interactively
$plinkArgs = @("-batch", "-ssh", "-P", $Port, "-i", $env:PPK_PATH, $Target)
$pscpArgs = @("-batch", "-P", $Port, "-i", $env:PPK_PATH)

Write-Host "==> Repo:  $RepoRoot"
Write-Host "==> Branch: $Branch"
Write-Host "==> Remote: ${Target}:${Remote}"
Write-Host "==> Key:    $($env:PPK_PATH)"
Write-Host ""

Set-Location $RepoRoot
git fetch origin
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

git rev-parse --verify "$Ref" 2>$null
if ($LASTEXITCODE -ne 0) {
    Write-Error "Git ref not found: $Ref"
}

if ($DryRun) {
    Write-Host "[dry-run] git archive --worktree-attributes $Ref -> $LocalTar"
    Write-Host "[dry-run] plink: STAGE=`$(mktemp -d <plugins-dir>/.bd-deploy-XXXXXXXX)"
    Write-Host "[dry-run] pscp -> ${Target}:`$STAGE/payload.tar"
    Write-Host "[dry-run] plink: extract to `$STAGE/new, verify plugin.php, locate wp-config.php,"
    Write-Host "[dry-run]        chown to webroot owner, swap into $Remote"
    exit 0
}

Write-Host "==> Creating archive..."
if (Test-Path $LocalTar) { Remove-Item $LocalTar -Force }
git archive --worktree-attributes --format=tar -o $LocalTar $Ref
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

# Stage inside a fresh mktemp -d beside the target rather than a fixed name in
# /tmp. A constant world-writable path let any local user on a shared host
# pre-create the file (or a symlink to it) and swap the archive between upload
# and extraction, so root extracted attacker-controlled content into the webroot.
# mktemp -d creates a fresh 0700 directory in a non-world-writable parent or fails.
$RemoteParent = $Remote.Substring(0, $Remote.LastIndexOf('/'))
Write-Host "==> Creating remote staging directory..."
$StageDir = (& $Plink @plinkArgs "mkdir -p '$RemoteParent' && mktemp -d '$RemoteParent/.bd-deploy-XXXXXXXX'" 2>&1 |
             Where-Object { $_ -match '^/' } | Select-Object -Last 1)
if ($LASTEXITCODE -ne 0 -or [string]::IsNullOrWhiteSpace($StageDir)) {
    Remove-Item $LocalTar -Force -ErrorAction SilentlyContinue
    Write-Error "Could not create remote staging directory under $RemoteParent (plink exit $LASTEXITCODE)."
}
$StageDir = $StageDir.Trim()
Write-Host "    $StageDir"

$RemoteTar = "$StageDir/payload.tar"

Write-Host "==> Uploading to server (pscp)..."
& $Pscp @pscpArgs $LocalTar "${Target}:${RemoteTar}"
if ($LASTEXITCODE -ne 0) {
    Remove-Item $LocalTar -Force -ErrorAction SilentlyContinue
    & $Plink @plinkArgs "rm -rf -- '$StageDir'" | Out-Null
    Write-Error "Upload failed (pscp exit $LASTEXITCODE)."
}

# Single-quoted here-string: the body is literal shell, so there is no PowerShell
# escaping to get wrong. Placeholders are substituted after validation above.
$remoteScript = @'
set -eu
TARGET='__TARGET__'
STAGE='__STAGE__'
BACKUP='__BACKUP__'

cleanup() { rm -rf -- "$STAGE"; }
trap cleanup EXIT

mkdir -p "$STAGE/new"
tar -xf "$STAGE/payload.tar" -C "$STAGE/new"

# Positive proof the payload arrived intact before anything live is touched.
# A size check alone passes a 1-byte truncated file, so require the WordPress
# plugin header and the elements directory the plugin cannot work without.
grep -q '^ \* Plugin Name:' "$STAGE/new/plugin.php" 2>/dev/null \
    || { echo "STAGED_PAYLOAD_INVALID" >&2; exit 1; }
[ -d "$STAGE/new/elements" ] || { echo "STAGED_PAYLOAD_INCOMPLETE" >&2; exit 1; }

# Locate the WordPress root by finding wp-config.php, rather than counting
# parent directories. A positional dirname chain silently resolves to the wrong
# tree when the configured path sits at an unexpected depth, and root then
# chown -R'd whatever it landed on.
webroot=""
d=$(dirname "$TARGET")
while [ "$d" != "/" ] && [ -n "$d" ]; do
    if [ -f "$d/wp-config.php" ]; then webroot="$d"; break; fi
    d=$(dirname "$d")
done
[ -n "$webroot" ] || { echo "NO_WPCONFIG_ABOVE_TARGET" >&2; exit 1; }

owner=$(stat -c '%U:%G' "$webroot")
[ -n "$owner" ] || { echo "NO_OWNER" >&2; exit 1; }

# Deploy runs as root; PHP/LiteSpeed must own the plugin or Element Studio
# cannot mkdir/save. Scope: the staged tree only, never the webroot.
chown -R "$owner" "$STAGE/new"

if [ "$BACKUP" = "1" ] && [ -d "$TARGET" ]; then
    cp -a "$TARGET" "${TARGET}.bak-$(date +%Y%m%d-%H%M%S)"
fi

# Swap: replaces the tree wholesale, so elements deleted from the repo do not
# survive as orphans and cause duplicate-class fatals.
RETIRED="${TARGET}.retired-$(date +%Y%m%d-%H%M%S)-$$"
if [ -e "$TARGET" ]; then mv -- "$TARGET" "$RETIRED"; fi
if mv -- "$STAGE/new" "$TARGET"; then
    rm -rf -- "$RETIRED"
else
    if [ -e "$RETIRED" ]; then mv -- "$RETIRED" "$TARGET"; fi
    echo "SWAP_FAILED" >&2
    exit 1
fi

echo DEPLOY_OK
'@

$BackupFlag = if ($env:REMOTE_BACKUP -eq "1") { "1" } else { "0" }

$remoteCmd = $remoteScript
$remoteCmd = $remoteCmd.Replace('__TARGET__', $Remote)
$remoteCmd = $remoteCmd.Replace('__STAGE__', $StageDir)
$remoteCmd = $remoteCmd.Replace('__BACKUP__', $BackupFlag)

Write-Host "==> Extracting on server (plink)..."
$output = & $Plink @plinkArgs $remoteCmd 2>&1
$output | ForEach-Object { Write-Host $_ }

$outText = $output | Out-String
if ($LASTEXITCODE -ne 0 -or $outText -notmatch 'DEPLOY_OK') {
    Write-Error "Deploy failed (plink exit $LASTEXITCODE). Output: $outText"
}

Remove-Item $LocalTar -Force -ErrorAction SilentlyContinue

Write-Host "==> Verifying plugin.php version on server..."
$verify = & $Plink @plinkArgs "grep -m1 '^ \* Version:' '$Remote/plugin.php' || grep -m1 Version '$Remote/plugin.php'"
Write-Host $verify
Write-Host "==> Done."
