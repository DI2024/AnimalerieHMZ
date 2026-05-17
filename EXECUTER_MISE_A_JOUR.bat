@echo off
chcp 65001 >nul
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║     MISE À JOUR DES PRODUITS - AnimalerieHMZ                   ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.
echo ⚠️  ATTENTION: Ce script va remplacer tous les produits existants!
echo.
echo Avant de continuer, assurez-vous d'avoir:
echo   ✓ Fait une sauvegarde de votre base de données
echo   ✓ Vérifié que les images existent dans public/images/products/
echo.
pause
echo.
echo ═══════════════════════════════════════════════════════════════
echo ÉTAPE 1: Sauvegarde de la base de données
echo ═══════════════════════════════════════════════════════════════
echo.
set BACKUP_FILE=backup_animaleriehmz_%date:~-4,4%%date:~-7,2%%date:~-10,2%_%time:~0,2%%time:~3,2%%time:~6,2%.sql
set BACKUP_FILE=%BACKUP_FILE: =0%
echo Création de la sauvegarde: %BACKUP_FILE%
echo.
mysqldump -u root -p animaleriehmz > %BACKUP_FILE%
if %errorlevel% neq 0 (
    echo ❌ Erreur lors de la sauvegarde!
    echo Vérifiez que MySQL est installé et accessible.
    pause
    exit /b 1
)
echo ✓ Sauvegarde créée avec succès: %BACKUP_FILE%
echo.
pause
echo.
echo ═══════════════════════════════════════════════════════════════
echo ÉTAPE 2: Exécution du script de mise à jour
echo ═══════════════════════════════════════════════════════════════
echo.
echo Mise à jour des produits en cours...
mysql -u root -p animaleriehmz < update_products.sql
if %errorlevel% neq 0 (
    echo ❌ Erreur lors de la mise à jour!
    echo.
    echo Pour restaurer la sauvegarde:
    echo mysql -u root -p animaleriehmz ^< %BACKUP_FILE%
    pause
    exit /b 1
)
echo ✓ Mise à jour effectuée avec succès!
echo.
pause
echo.
echo ═══════════════════════════════════════════════════════════════
echo ÉTAPE 3: Vérification des données
echo ═══════════════════════════════════════════════════════════════
echo.
echo Vérification en cours...
mysql -u root -p animaleriehmz < verify_products.sql
echo.
pause
echo.
echo ═══════════════════════════════════════════════════════════════
echo ÉTAPE 4: Test d'affichage (PHP)
echo ═══════════════════════════════════════════════════════════════
echo.
echo Lancement du test d'affichage...
php test_products_display.php
echo.
pause
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║                    MISE À JOUR TERMINÉE                        ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.
echo ✅ La mise à jour est terminée!
echo.
echo Prochaines étapes:
echo   1. Ouvrir votre site: http://localhost
echo   2. Vérifier l'affichage des produits
echo   3. Tester les catégories
echo   4. Vérifier le panneau admin
echo.
echo Fichiers créés:
echo   • Sauvegarde: %BACKUP_FILE%
echo   • Logs: Vérifier storage/logs/laravel.log
echo.
echo En cas de problème, restaurez la sauvegarde:
echo   mysql -u root -p animaleriehmz ^< %BACKUP_FILE%
echo.
pause
