<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711115552 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE technology_type (
            id SERIAL PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
        )');

        $this->addSql('CREATE TABLE technology (
            id SERIAL PRIMARY KEY,
            technology_type_id INT NOT NULL,
            name VARCHAR(50) DEFAULT NULL,
            url VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL,
            CONSTRAINT uniq_name UNIQUE (name),
            CONSTRAINT fk_technology_type_id FOREIGN KEY (technology_type_id) REFERENCES technology_type (id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE technology DROP CONSTRAINT IF EXISTS FK_F463524D8402C925');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE technology_type');
    }
}
