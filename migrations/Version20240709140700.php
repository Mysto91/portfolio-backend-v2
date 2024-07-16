<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240709140700 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE company (
                id SERIAL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                url VARCHAR(255) DEFAULT NULL,
                logo VARCHAR(100) DEFAULT NULL,
                logo_class VARCHAR(100) DEFAULT NULL,
                created_at TIMESTAMP NOT NULL,
                updated_at TIMESTAMP DEFAULT NULL
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE company CASCADE');
    }
}
