Installation:

1) Clone the project from the github repository
git clone https://github.com/maherwess/SportymaTest.git

2) Installer les dépendances
composer install

3) Alimenter la base de données à l'aide des data fixtures
php bin/console doctrine:fixtures:load

Attention : il faut executer cette commande une seul fois parceque les photos seront coupés
et déplacer vers la déstination appropriée

4) executer le projet :) 