<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711070145 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE project (
                id SERIAL PRIMARY KEY,
                uuid UUID DEFAULT gen_random_uuid() NOT NULL,
                title VARCHAR(100) NOT NULL,
                description TEXT NOT NULL,
                app_url VARCHAR(100) DEFAULT NULL,
                github_url VARCHAR(100) DEFAULT NULL,
                overview VARCHAR(100) NOT NULL,
                credits TEXT DEFAULT NULL,
                main_image_url VARCHAR(200) DEFAULT NULL,
                first_image_url VARCHAR(200) DEFAULT NULL,
                second_image_url VARCHAR(200) DEFAULT NULL,
                created_at TIMESTAMP NOT NULL,
                updated_at TIMESTAMP NOT NULL
            )'
        );

        $this->addSql('ALTER TABLE company ALTER COLUMN updated_at SET NOT NULL');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE project');
        $this->addSql('ALTER TABLE company ALTER COLUMN updated_at DROP NOT NULL');
    }
}
