# Load your bweb2 SSH key into ssh-agent (run once per PowerShell session).
# Enter your KEY PASSPHRASE when prompted — same as PuTTY, NOT your server login password.

$ErrorActionPreference = "Stop"
# Set BD_DEPLOY_SSH_KEY to override; otherwise edit the fallback below.
$key = if ($env:BD_DEPLOY_SSH_KEY) { $env:BD_DEPLOY_SSH_KEY } else { "$env:USERPROFILE\.ssh\id_ed25519" }

if (-not (Test-Path $key)) {
    Write-Error "Key not found: $key"
}

$agent = Get-Service ssh-agent -ErrorAction SilentlyContinue
if ($agent -and $agent.Status -ne 'Running') {
    Set-Service ssh-agent -StartupType Manual
    Start-Service ssh-agent
    Write-Host "Started ssh-agent."
}

ssh-add $key
Write-Host ""
ssh-add -l
Write-Host ""
Write-Host "Test: ssh <your-ssh-host-alias> `"echo ok`""
