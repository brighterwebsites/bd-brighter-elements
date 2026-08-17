# Run this file ONCE in PowerShell as Administrator (right-click → Run as administrator).
# Enables ssh-agent so: ssh-add, then deploy-bd-bw

$ErrorActionPreference = "Stop"

Set-Service ssh-agent -StartupType Manual
Start-Service ssh-agent

Write-Host "ssh-agent status:" (Get-Service ssh-agent).Status
Write-Host ""
Write-Host "Now in a NORMAL PowerShell window run:"
Write-Host "  ssh-add `$env:USERPROFILE\.ssh\<your-key>"
Write-Host "  ssh <your-ssh-host-alias> `"echo ok`""
Write-Host "  deploy-bd-bw"
