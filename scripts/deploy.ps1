# Deploy wrapper for Windows (Git Bash).
# v1.0 | 2026-05-18
#
# Usage: .\scripts\deploy.ps1
#        .\scripts\deploy.ps1 -DryRun

param(
    [switch]$DryRun
)

$ErrorActionPreference = "Stop"
$RepoRoot = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)
$DeploySh = Join-Path $RepoRoot "scripts\deploy.sh"

$GitBash = @(
    "${env:ProgramFiles}\Git\bin\bash.exe"
    "${env:ProgramFiles(x86)}\Git\bin\bash.exe"
) | Where-Object { Test-Path $_ } | Select-Object -First 1

if (-not $GitBash) {
    Write-Error "Git Bash not found. Install Git for Windows, or run scripts/deploy.sh from Git Bash."
}

$bashPath = ($DeploySh -replace '\\', '/')
$args = @("-lc", "cd '$($RepoRoot -replace '\\', '/')' && bash '$bashPath'")
if ($DryRun) { $args[1] += " --dry-run" }

& $GitBash $args
