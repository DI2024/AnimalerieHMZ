# Guide d'installation - AnimalerieHMZ

## Problème actuel
La base de données MySQL n'est pas installée sur votre système.

## Solutions possibles

### Option 1 : Installer XAMPP (Recommandé - Plus facile)

1. Télécharger XAMPP depuis : https://www.apachefriends.org/fr/download.html
2. Installer XAMPP
3. Démarrer le module MySQL depuis le panneau de contrôle XAMPP
4. Exécuter `setup-database.bat` (sans mot de passe, appuyez juste sur Entrée)
5. Exécuter `start-servers.bat`

### Option 2 : Installer MySQL seul

1. Télécharger MySQL depuis : https://dev.mysql.com/downloads/installer/
2. Installer MySQL Community Server
3. Noter le mot de passe root que vous définissez
4. Mettre à jour le fichier `.env` avec votre mot de passe :
   ```
   DB_PASSWORD=votre_mot_de_passe
   ```
5. Exécuter `setup-database.bat`
6. Exécuter `start-servers.bat`

### Option 3 : Utiliser une base de données en ligne (Temporaire)

Si vous voulez juste tester rapidement, vous pouvez utiliser une base de données MySQL gratuite en ligne comme :
- db4free.net
- freemysqlhosting.net

Puis mettre à jour les informations dans `.env`

## Après l'installation de MySQL

1. Double-cliquez sur `setup-database.bat` pour créer la base de données
2. Double-cliquez sur `start-servers.bat` pour lancer l'application
3. L'application s'ouvrira automatiquement dans votre navigateur

## Besoin d'aide ?

Si vous rencontrez des problèmes, vérifiez que :
- MySQL est bien démarré
- Le port 3306 est disponible
- Les informations dans `.env` sont correctes
