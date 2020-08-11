Installation:

1) Clone the project from the github repository
git clone https://github.com/maherwess/SportymaTest.git

2) Installer les dépendances
composer install

3)Configurer la base de données
Se pointer dans le fichier ..youtPath\SportymaTest\.env
changer la ligne de configuration :
DATABASE_URL=mysql://root:@127.0.0.1:3306/football?serverVersion=5.7
pour mettre vos information de base de données !
changer
root : nom d'utilisateur de la base de données
password : yourpassword

4) crèer la base de donnée avec ces 3 commande :
php bin/console d:d:create
php bin.console make:migration
php bin/console doctrine:migrations:migrate

3) Alimenter la base de données à l'aide des data fixtures:
php bin/console doctrine:fixtures:load

4) executer le projet :) 