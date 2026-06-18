# Run this file ONCE in PowerShell as Administrator (right-click → Run as administrator).
# Enables ssh-agent so: ssh-add, then deploy-bd-bw

$ErrorActionPreference = "Stop"

Set-Service ssh-agent -StartupType Manual
Start-Service ssh-agent

Write-Host "ssh-agent status:" (Get-Service ssh-agent).Status
Write-Host ""
Write-Host "Now in a NORMAL PowerShell window run:"
Write-Host "  ssh-add `$env:USERPROFILE\.ssh\eddsa-key-20260519"
Write-Host "  ssh bweb2-bw `"echo ok`""
Write-Host "  deploy-bd-bw"
