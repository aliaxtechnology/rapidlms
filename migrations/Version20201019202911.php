<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Lms\Core\Migrations\BaseMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201019202911 extends BaseMigration
{
    public function getDescription() : string
    {
        return '';
    }

    protected function upMysSql(Schema $schema): void
    {
        $this->addSql('CREATE TABLE resource_sequence ( id INT AUTO_INCREMENT PRIMARY KEY );');
    }

    protected function downMysSql(Schema $schema): void
    {
        $this->addSql('DROP TABLE resource_sequence');
    }

    protected function upSqlite(Schema $schema): void
    {
        $this->addSql('CREATE TABLE resource_sequence ( id INT AUTO_INCREMENT PRIMARY KEY);');
    }

    protected function downSqlite(Schema $schema): void
    {
        $this->addSql('DROP TABLE resource_sequence');
    }
}
