<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240715085955 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject_degree (subject_id INT NOT NULL, degree_id INT NOT NULL, INDEX IDX_2FBAA44423EDC87 (subject_id), INDEX IDX_2FBAA444B35C5756 (degree_id), PRIMARY KEY(subject_id, degree_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subject_degree ADD CONSTRAINT FK_2FBAA44423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_degree ADD CONSTRAINT FK_2FBAA444B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subject_degree DROP FOREIGN KEY FK_2FBAA44423EDC87');
        $this->addSql('ALTER TABLE subject_degree DROP FOREIGN KEY FK_2FBAA444B35C5756');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE subject_degree');
    }
}
