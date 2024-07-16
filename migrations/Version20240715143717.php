<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715143717 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "user" (
            id SERIAL PRIMARY KEY,
            username VARCHAR(180) NOT NULL,
            roles JSONB NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL,
            CONSTRAINT uniq_email UNIQUE (email),
            CONSTRAINT uniq_username UNIQUE (username)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE experience ALTER COLUMN id DROP DEFAULT');
    }
}
