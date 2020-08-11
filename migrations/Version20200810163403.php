<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810163403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE but (id INT AUTO_INCREMENT NOT NULL, joueur_id INT DEFAULT NULL, saison_id INT DEFAULT NULL, nombre INT NOT NULL, INDEX IDX_B132FECAA9E2D76C (joueur_id), UNIQUE INDEX UNIQ_B132FECAF965414C (saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, logo_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, num VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueurs_clubs (joueur_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_CE239EDBA9E2D76C (joueur_id), INDEX IDX_CE239EDB61190A32 (club_id), PRIMARY KEY(joueur_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, anneedebut DATE NOT NULL, anneefin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECAA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECAF965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE joueurs_clubs ADD CONSTRAINT FK_CE239EDBA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueurs_clubs ADD CONSTRAINT FK_CE239EDB61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueurs_clubs DROP FOREIGN KEY FK_CE239EDB61190A32');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECAA9E2D76C');
        $this->addSql('ALTER TABLE joueurs_clubs DROP FOREIGN KEY FK_CE239EDBA9E2D76C');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECAF965414C');
        $this->addSql('DROP TABLE but');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE joueurs_clubs');
        $this->addSql('DROP TABLE saison');
    }
}
