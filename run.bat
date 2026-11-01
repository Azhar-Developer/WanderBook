@echo off
echo ========================================================
echo Starting GYPSY Travel Management System...
echo ========================================================

tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo [OK] MariaDB database is already running.
) else (
    echo Starting MariaDB database server...
    start /B "" "C:\Users\welcome\mariadb\bin\mysqld.exe" --datadir="C:\Users\welcome\mariadb\data"
    timeout /t 2 >nul
)

echo [OK] Opening application in browser at http://localhost:8000/
start "" "http://localhost:8000/"

echo [OK] PHP development server running on port 8000 (Press Ctrl+C to stop)...
"C:\Users\welcome\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" -S localhost:8000 -t "%~dp0."

