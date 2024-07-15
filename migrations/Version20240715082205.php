<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715082205 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE functionality (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, description LONGTEXT NOT NULL, code VARCHAR(10) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F83C5F4477153098 (code), INDEX IDX_F83C5F44166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE functionality ADD CONSTRAINT FK_F83C5F44166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE functionality DROP FOREIGN KEY FK_F83C5F44166D1F9C');
        $this->addSql('DROP TABLE functionality');
    }
}
