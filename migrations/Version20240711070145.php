<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711070145 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE project (id INT NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, app_url VARCHAR(100) DEFAULT NULL, github_url VARCHAR(100) DEFAULT NULL, overview VARCHAR(100) NOT NULL, credits LONGTEXT DEFAULT NULL, main_image_url VARCHAR(200) DEFAULT NULL, first_image_url VARCHAR(200) DEFAULT NULL, second_image_url VARCHAR(200) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2FB3D0EED17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE project');
        $this->addSql('ALTER TABLE company CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
