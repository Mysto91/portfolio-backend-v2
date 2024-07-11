<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240711115552 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, technology_type_id INT NOT NULL, name VARCHAR(50) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F463524D5E237E06 (name), INDEX IDX_F463524D8402C925 (technology_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE technology ADD CONSTRAINT FK_F463524D8402C925 FOREIGN KEY (technology_type_id) REFERENCES technology_type (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE technology DROP FOREIGN KEY FK_F463524D8402C925');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE technology_type');
    }
}
