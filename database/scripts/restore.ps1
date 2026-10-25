# Restore proof for CampusConnect.
# Restores the latest backup into a SEPARATE database (campusconnect_test),
# then compares row counts with the real database.
# Usage: powershell -ExecutionPolicy Bypass -File database\scripts\restore.ps1

param([string]$DumpFile)

$pgBin  = "C:\Program Files\PostgreSQL\18\bin"
$testDb = "campusconnect_test"

# No file given? Use the newest dump in database\backups
if (-not $DumpFile) {
    $DumpFile = (Get-ChildItem (Join-Path $PSScriptRoot "..\backups\*.dump") |
        Sort-Object LastWriteTime -Descending | Select-Object -First 1).FullName
}
Write-Host "Restoring from: $DumpFile"

# Creating a database needs a superuser
$secure = Read-Host "Password for postgres (superuser)" -AsSecureString
$env:PGPASSWORD = [Runtime.InteropServices.Marshal]::PtrToStringAuto(
    [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure))

# 1) Fresh, empty test database. The real database is never touched.
& "$pgBin\psql.exe" -h 127.0.0.1 -U postgres -d postgres -c "DROP DATABASE IF EXISTS $testDb;"
& "$pgBin\psql.exe" -h 127.0.0.1 -U postgres -d postgres -c "CREATE DATABASE $testDb OWNER campus_owner;"

# 2) Load the backup into it
& "$pgBin\pg_restore.exe" -h 127.0.0.1 -U postgres -d $testDb $DumpFile

# 3) Compare row counts in both databases
$sql = "SELECT 'users' AS tbl, count(*) FROM users " +
       "UNION ALL SELECT 'categories', count(*) FROM categories " +
       "UNION ALL SELECT 'locations', count(*) FROM locations " +
       "UNION ALL SELECT 'events', count(*) FROM events " +
       "UNION ALL SELECT 'event_participants', count(*) FROM event_participants " +
       "UNION ALL SELECT 'event_status_logs', count(*) FROM event_status_logs;"

foreach ($db in @("campusconnect", $testDb)) {
    Write-Host "`n=== $db ==="
    & "$pgBin\psql.exe" -h 127.0.0.1 -U postgres -d $db -c $sql
}

# 4) Check that the trigger and constraints came back too
Write-Host "`n=== trigger and constraints in $testDb ==="
& "$pgBin\psql.exe" -h 127.0.0.1 -U postgres -d $testDb -c "SELECT tgname FROM pg_trigger WHERE tgname = 'trg_event_status_log';"
& "$pgBin\psql.exe" -h 127.0.0.1 -U postgres -d $testDb -c "SELECT conname FROM pg_constraint WHERE conname LIKE 'events_%check' OR conname = 'users_role_check' ORDER BY conname;"

Remove-Item Env:PGPASSWORD