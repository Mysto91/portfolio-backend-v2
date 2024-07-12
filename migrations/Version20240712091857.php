<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712091857 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, position VARCHAR(50) NOT NULL, overview VARCHAR(400) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', contract_type VARCHAR(255) DEFAULT \'CDI\' NOT NULL, INDEX IDX_590C103979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103979B1AD6');
        $this->addSql('DROP TABLE experience');
    }
}
