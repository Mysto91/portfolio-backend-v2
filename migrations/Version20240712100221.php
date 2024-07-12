<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712100221 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE experience_technology (experience_id INT NOT NULL, technology_id INT NOT NULL, show_in_overview TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1BC2EDF146E90E27 (experience_id), INDEX IDX_1BC2EDF14235D463 (technology_id), PRIMARY KEY(experience_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF14235D463 FOREIGN KEY (technology_id) REFERENCES technology (id)');
        $this->addSql('ALTER TABLE experience ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_1BC2EDF146E90E27');
        $this->addSql('ALTER TABLE experience_technology DROP FOREIGN KEY FK_1BC2EDF14235D463');
        $this->addSql('DROP TABLE experience_technology');
        $this->addSql('ALTER TABLE experience DROP created_at, DROP updated_at');
    }
}
