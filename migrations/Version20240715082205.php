<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715082205 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE functionality (
            id SERIAL PRIMARY KEY,
            project_id INT NOT NULL,
            description TEXT NOT NULL,
            code VARCHAR(10) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL,
            CONSTRAINT uniq_code UNIQUE (code),
            CONSTRAINT fk_project_id FOREIGN KEY (project_id) REFERENCES project (id)
        )');

        $this->addSql('CREATE INDEX IDX_F83C5F44166D1F9C ON functionality (project_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE functionality DROP CONSTRAINT fk_project_id');
        $this->addSql('DROP TABLE functionality');
    }
}
