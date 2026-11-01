# GYPSY Travel Management System Startup Script
Write-Host "========================================================" -ForegroundColor Cyan
Write-Host "Starting GYPSY Travel Management System..." -ForegroundColor Green
Write-Host "========================================================" -ForegroundColor Cyan

$mysqldProc = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue
if ($null -eq $mysqldProc) {
    Write-Host "[+] Starting MariaDB database..." -ForegroundColor Yellow
    Start-Process -FilePath "C:\Users\welcome\mariadb\bin\mysqld.exe" -ArgumentList '--datadir="C:\Users\welcome\mariadb\data"' -WindowStyle Hidden
    Start-Sleep -Seconds 2
} else {
    Write-Host "[OK] MariaDB database is already running." -ForegroundColor Green
}

Write-Host "[+] Opening http://localhost:8000/ in default browser..." -ForegroundColor Yellow
Start-Process "http://localhost:8000/"

Write-Host "[OK] Starting PHP Web Server on http://localhost:8000 (Ctrl+C to exit)..." -ForegroundColor Green
& "C:\Users\welcome\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" -S localhost:8000 -t $PSScriptRoot

