<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240709152633 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE degree (
                id SERIAL PRIMARY KEY,
                company_id INT DEFAULT NULL,
                uuid UUID DEFAULT gen_random_uuid() NOT NULL,
                title VARCHAR(50) NOT NULL,
                description TEXT DEFAULT NULL,
                graduated_date TIMESTAMP DEFAULT NULL,
                created_at TIMESTAMP NOT NULL,
                updated_at TIMESTAMP NOT NULL,
                CONSTRAINT uniq_uuid UNIQUE (uuid),
                CONSTRAINT fk_company_id FOREIGN KEY (company_id) REFERENCES company (id)
            )'
        );

        $this->addSql('CREATE INDEX IDX_A7A36D63979B1AD6 ON degree (company_id)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE degree DROP CONSTRAINT IF EXISTS FK_A7A36D63979B1AD6');
        $this->addSql('DROP TABLE degree');
    }
}
