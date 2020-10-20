<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Lms\Core\Migrations\BaseMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201018121001 extends BaseMigration
{
    public function getDescription() : string
    {
        return '';
    }

    protected function upMysSql(Schema $schema): void
    {
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    protected function downMysSql(Schema $schema): void
    {
        $this->addSql('DROP TABLE resource');
    }

    protected function upSqlite(Schema $schema): void
    {
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id));');
    }

    protected function downSqlite(Schema $schema): void
    {
        $this->addSql('DROP TABLE resource');
    }


}
