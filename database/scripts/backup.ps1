# Backup script for CampusConnect (PostgreSQL).
# Usage: powershell -ExecutionPolicy Bypass -File database\scripts\backup.ps1

$pgBin     = "C:\Program Files\PostgreSQL\18\bin"
$backupDir = Join-Path $PSScriptRoot "..\backups"
$stamp     = Get-Date -Format "yyyyMMdd_HHmmss"
$file      = Join-Path $backupDir "campusconnect_$stamp.dump"

New-Item -ItemType Directory -Force -Path $backupDir | Out-Null

# Ask for the password so it is never written in this file
$secure = Read-Host "Password for campus_backup" -AsSecureString
$env:PGPASSWORD = [Runtime.InteropServices.Marshal]::PtrToStringAuto(
    [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure))

# -F c = custom format (compressed, works with pg_restore)
& "$pgBin\pg_dump.exe" -h 127.0.0.1 -p 5432 -U campus_backup -d campusconnect -F c -f $file

Remove-Item Env:PGPASSWORD

if ($LASTEXITCODE -ne 0) {
    Write-Error "Backup FAILED."
    exit 1
}

Write-Host "Backup OK: $file"
Write-Host ("Size: {0:N0} bytes" -f (Get-Item $file).Length)