<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240712153416 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_590C103D17F50A6 ON experience (uuid)');
        $this->addSql('ALTER TABLE technology DROP url');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE technology ADD url VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_590C103D17F50A6 ON experience');
    }
}
