<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811124754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE but DROP INDEX UNIQ_B132FECA61190A32, ADD INDEX IDX_B132FECA61190A32 (club_id)');
        $this->addSql('ALTER TABLE but DROP INDEX UNIQ_B132FECAF965414C, ADD INDEX IDX_B132FECAF965414C (saison_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE but DROP INDEX IDX_B132FECAF965414C, ADD UNIQUE INDEX UNIQ_B132FECAF965414C (saison_id)');
        $this->addSql('ALTER TABLE but DROP INDEX IDX_B132FECA61190A32, ADD UNIQUE INDEX UNIQ_B132FECA61190A32 (club_id)');
    }
}
