<?php

namespace Lms\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

abstract class BaseMigration extends AbstractMigration{


    abstract protected function upSqlite(Schema $schema): void;
    abstract protected function downSqlite(Schema $schema): void;

    abstract protected function upMysSql(Schema $schema): void;
    abstract protected function downMysSql(Schema $schema): void;

    public function up(Schema $schema) : void
    {
        $engine = $this->connection->getDriver()->getDatabasePlatform()->getName();

        if ('sqlite' === $engine)
            $this->upSqlite($schema);
        else
            $this->upMysSql($schema);
    }

    public function down(Schema $schema) : void
    {
        $engine = $this->connection->getDriver()->getDatabasePlatform()->getName();

        if ('sqlite' === $engine)
            $this->downSqlite($schema);
        else
            $this->downMysSql($schema);
    }
}