# Adds deploy-bd-bw function to your PowerShell profile (current user).
# Run once: .\scripts\install-deploy-alias.ps1

$ErrorActionPreference = "Stop"
$RepoRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$RepoRootEscaped = $RepoRoot -replace "'", "''"

$FunctionBlock = @"

# Brighter BD Elements — deploy to WordPress (bd-brighter-elements)
function deploy-bd-bw {
    param([switch]`$DryRun)
    `$deploy = Join-Path '$RepoRootEscaped' 'scripts\deploy.ps1'
    if (-not (Test-Path `$deploy)) {
        Write-Error "Deploy script not found: `$deploy"
    }
    if (`$DryRun) {
        & `$deploy -DryRun
    } else {
        & `$deploy
    }
}

"@

if (-not (Test-Path $PROFILE)) {
    New-Item -Path $PROFILE -ItemType File -Force | Out-Null
}

$profileContent = Get-Content -Path $PROFILE -Raw -ErrorAction SilentlyContinue
if ($profileContent -and $profileContent -match 'function deploy-bd-bw') {
    Write-Host "deploy-bd-bw already exists in: $PROFILE"
    Write-Host "Update manually if the repo path changed."
    exit 0
}

Add-Content -Path $PROFILE -Value $FunctionBlock
Write-Host "Added deploy-bd-bw to: $PROFILE"
Write-Host "Restart PowerShell or run: . `$PROFILE"
Write-Host "Then: copy scripts\deploy.env.example to scripts\deploy.env and fill in SSH details."
