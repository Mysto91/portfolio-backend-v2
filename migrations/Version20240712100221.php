<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712100221 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE experience_technology (
            experience_id INT NOT NULL,
            technology_id INT NOT NULL,
            show_in_overview SMALLINT DEFAULT 1 NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL,
            PRIMARY KEY(experience_id, technology_id),
            CONSTRAINT fk_experience_id FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE,
            CONSTRAINT fk_technology_id FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE INDEX IDX_1BC2EDF146E90E27 ON experience_technology (experience_id)');
        $this->addSql('CREATE INDEX IDX_1BC2EDF14235D463 ON experience_technology (technology_id)');

        $this->addSql('ALTER TABLE experience ADD created_at TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE experience ADD updated_at TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT fk_experience_id');
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT fk_technology_id');
        $this->addSql('DROP TABLE experience_technology');
        $this->addSql('ALTER TABLE experience DROP COLUMN created_at, DROP COLUMN updated_at');
    }
}
