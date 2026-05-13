@echo off
echo ========================================
echo Demarrage des serveurs AnimalerieHMZ
echo ========================================
echo.

REM Lancer le serveur Laravel dans une nouvelle fenetre
start "Laravel Server" cmd /k "php artisan serve"

REM Attendre 3 secondes pour que Laravel demarre
echo Demarrage du serveur Laravel...
timeout /t 3 /nobreak >nul

REM Lancer Vite dans une nouvelle fenetre
start "Vite Dev Server" cmd /k "npm run dev"

REM Attendre 3 secondes pour que Vite demarre
echo Demarrage du serveur Vite...
timeout /t 3 /nobreak >nul

REM Ouvrir le navigateur sur l'application
echo Ouverture de l'application dans le navigateur...
start http://localhost:8000

echo.
echo ========================================
echo Les serveurs sont demarres!
echo Laravel: http://localhost:8000
echo Vite: http://localhost:5173
echo ========================================
echo.
echo Pour arreter les serveurs, fermez les fenetres "Laravel Server" et "Vite Dev Server"
echo.
pause
