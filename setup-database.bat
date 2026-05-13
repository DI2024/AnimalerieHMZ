@echo off
echo ========================================
echo Configuration de la base de donnees
echo ========================================
echo.

REM Verifier si MySQL XAMPP est en cours d'execution
echo Verification de MySQL...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="1" (
    echo ERREUR: MySQL n'est pas demarre!
    echo Veuillez demarrer MySQL depuis le panneau de controle XAMPP.
    pause
    exit /b 1
)

echo MySQL est en cours d'execution.
echo.

REM Creer la base de donnees MySQL avec XAMPP (pas de mot de passe par defaut)
echo Creation de la base de donnees animalerie_hmz...
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS animalerie_hmz CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if %ERRORLEVEL% NEQ 0 (
    echo ERREUR lors de la creation de la base de donnees!
    pause
    exit /b 1
)

echo Base de donnees creee avec succes!
echo.
echo Execution des migrations Laravel...
php artisan migrate --force

echo.
echo ========================================
echo Configuration terminee avec succes!
echo ========================================
pause
