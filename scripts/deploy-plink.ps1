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

$HostRaw = if ($env:SSH_HOST) { $env:SSH_HOST } else { "host2.bweb1.com.au" }
$User = if ($env:SSH_USER) { $env:SSH_USER } else { "root" }
$Port = if ($env:SSH_PORT) { $env:SSH_PORT } else { "2822" }
$Remote = ($env:REMOTE_PLUGIN_PATH).TrimEnd('/')
$Branch = if ($env:DEPLOY_BRANCH) { $env:DEPLOY_BRANCH } else { "claude/breakdance-cpt-submissions-3qVD8" }
$Target = "${User}@${HostRaw}"
$Ref = "origin/$Branch"
$RemoteTar = "/tmp/bd-brighter-elements-deploy.tar"
$LocalTar = Join-Path $env:TEMP "bd-brighter-elements-deploy.tar"

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
    Write-Host "[dry-run] pscp -> ${Target}:${RemoteTar}"
    Write-Host "[dry-run] plink: backup, mkdir, tar -xf into $Remote"
    exit 0
}

Write-Host "==> Creating archive..."
if (Test-Path $LocalTar) { Remove-Item $LocalTar -Force }
git archive --worktree-attributes --format=tar -o $LocalTar $Ref
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

Write-Host "==> Uploading to server (pscp)..."
& $Pscp @pscpArgs $LocalTar "${Target}:${RemoteTar}"
if ($LASTEXITCODE -ne 0) {
    Remove-Item $LocalTar -Force -ErrorAction SilentlyContinue
    Write-Error "Upload failed (pscp exit $LASTEXITCODE)."
}

$remoteParts = @("set -e")
if ($env:REMOTE_BACKUP -eq "1") {
    $remoteParts += "if [ -d '$Remote' ]; then cp -a '$Remote' '${Remote}.bak-'`$(date +%Y%m%d-%H%M%S); fi"
}
$remoteParts += "mkdir -p '$Remote'"
# Remove stale element dirs left by older deploys (tar merge does not delete orphans)
$remoteParts += "if [ -d '$Remote/elements' ]; then find '$Remote/elements' -mindepth 1 -maxdepth 1 -exec rm -rf {} +; fi"
$remoteParts += "tar -xf '$RemoteTar' -C '$Remote'"
$remoteParts += "rm -f '$RemoteTar'"
# Deploy runs as root; PHP/LiteSpeed must own the plugin or Element Studio cannot mkdir/save.
$remoteParts += "publicHtml=`$(dirname `$(dirname `$(dirname '$Remote')))"
$remoteParts += "if [ -d '$Remote' ]; then chown -R `$(stat -c '%U:%G' `"`$publicHtml`") '$Remote'; fi"
$remoteParts += "echo DEPLOY_OK"
$remoteCmd = $remoteParts -join "; "

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
