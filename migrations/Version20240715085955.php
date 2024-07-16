<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715085955 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE subject (
            id SERIAL PRIMARY KEY,
            name VARCHAR(20) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
        )');

        $this->addSql('CREATE TABLE subject_degree (
            subject_id INT NOT NULL,
            degree_id INT NOT NULL,
            PRIMARY KEY(subject_id, degree_id),
            CONSTRAINT fk_subject_id FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE,
            CONSTRAINT fk_degree_id FOREIGN KEY (degree_id) REFERENCES degree (id) ON DELETE CASCADE
        )');

        $this->addSql('CREATE INDEX IDX_2FBAA44423EDC87 ON subject_degree (subject_id)');
        $this->addSql('CREATE INDEX IDX_2FBAA444B35C5756 ON subject_degree (degree_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subject_degree DROP CONSTRAINT fk_subject_id');
        $this->addSql('ALTER TABLE subject_degree DROP CONSTRAINT fk_degree_id');
        $this->addSql('DROP TABLE subject_degree');
        $this->addSql('DROP TABLE subject');
    }
}
