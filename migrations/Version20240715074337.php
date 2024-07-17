<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715074337 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE social_network (
            id SERIAL PRIMARY KEY,
            uuid UUID DEFAULT gen_random_uuid() NOT NULL,
            name VARCHAR(50) NOT NULL,
            url VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE social_network CASCADE');
    }
}
