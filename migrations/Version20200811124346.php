<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811124346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE but ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECA61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B132FECA61190A32 ON but (club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECA61190A32');
        $this->addSql('DROP INDEX UNIQ_B132FECA61190A32 ON but');
        $this->addSql('ALTER TABLE but DROP club_id');
    }
}
