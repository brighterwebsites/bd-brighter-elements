# Load your bweb2 SSH key into ssh-agent (run once per PowerShell session).
# Enter your KEY PASSPHRASE when prompted — same as PuTTY, NOT your server login password.

$ErrorActionPreference = "Stop"
$key = "$env:USERPROFILE\.ssh\eddsa-key-20260519"

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
Write-Host "Test: ssh bweb2-bw `"echo ok`""
