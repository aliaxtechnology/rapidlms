<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Lms\Core\Migrations\BaseMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023192721 extends BaseMigration
{
    public function getDescription() : string
    {
        return '';
    }

    protected function upMysSql(Schema $schema): void
    {
        $this->addSql('CREATE TABLE file (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, disk VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resource ADD type VARCHAR(20) NOT NULL, ADD preview_id INT NOT NULL');
    }

    protected function downMysSql(Schema $schema): void
    {
        $this->addSql('DROP TABLE file');
        $this->addSql('ALTER TABLE resource DROP type, DROP preview_id');
    }

    protected function upSqlite(Schema $schema): void
    {
        $this->addSql('CREATE TABLE file (id INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, disk VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE resource ADD COLUMN type VARCHAR(20)');
        $this->addSql('ALTER TABLE resource ADD COLUMN preview_id INT');
    }

    protected function downSqlite(Schema $schema): void
    {
        $this->addSql('DROP TABLE file');
        $this->addSql('ALTER TABLE resource DROP type, DROP preview_id');
    }
}
