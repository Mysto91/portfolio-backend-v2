<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712091857 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE experience (
            id SERIAL PRIMARY KEY,
            company_id INT NOT NULL,
            position VARCHAR(50) NOT NULL,
            overview VARCHAR(400) NOT NULL,
            description TEXT DEFAULT NULL,
            start_date TIMESTAMP NOT NULL,
            end_date TIMESTAMP DEFAULT NULL,
            uuid UUID DEFAULT gen_random_uuid() NOT NULL,
            contract_type VARCHAR(255) DEFAULT \'CDI\' NOT NULL,
            CONSTRAINT fk_company_id FOREIGN KEY (company_id) REFERENCES company (id)
        )');

        $this->addSql('CREATE INDEX IDX_590C103979B1AD6 ON experience (company_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE experience DROP CONSTRAINT fk_company_id');
        $this->addSql('DROP TABLE experience');
    }
}
