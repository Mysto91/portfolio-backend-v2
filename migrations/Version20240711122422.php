<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711122422 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE project_technology (
            project_id INT NOT NULL,
            technology_id INT NOT NULL,
            PRIMARY KEY(project_id, technology_id),
            CONSTRAINT fk_project_id FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE,
            CONSTRAINT fk_technology_id FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE INDEX IDX_ECC5297F166D1F9C ON project_technology (project_id)');
        $this->addSql('CREATE INDEX IDX_ECC5297F4235D463 ON project_technology (technology_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE project_technology DROP CONSTRAINT fk_project_id');
        $this->addSql('ALTER TABLE project_technology DROP CONSTRAINT fk_technology_id');
        $this->addSql('DROP TABLE project_technology');
    }
}
