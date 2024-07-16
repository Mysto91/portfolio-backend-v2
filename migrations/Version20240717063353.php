<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * SKIPPED
 */
final class Version20240717063353 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE degree_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE experience_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_network_id_seq CASCADE');
        $this->addSql('ALTER TABLE company ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE degree ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE degree ALTER uuid TYPE UUID');

        $this->addSql('COMMENT ON COLUMN degree.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER INDEX uniq_uuid RENAME TO UNIQ_A7A36D63D17F50A6');
        $this->addSql('ALTER TABLE experience ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE experience ALTER uuid TYPE UUID');

        $this->addSql('COMMENT ON COLUMN experience.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT fk_experience_id');
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT fk_technology_id');

        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview DROP DEFAULT');
        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview TYPE BOOLEAN USING CASE WHEN show_in_overview = 1 THEN TRUE ELSE FALSE END;');
        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview SET DEFAULT TRUE');

        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT FK_1BC2EDF14235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE functionality ALTER id DROP DEFAULT');
        $this->addSql('ALTER INDEX uniq_code RENAME TO UNIQ_F83C5F4477153098');
        $this->addSql('ALTER TABLE project ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE project ALTER uuid TYPE UUID');

        $this->addSql('COMMENT ON COLUMN project.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EED17F50A6 ON project (uuid)');
        $this->addSql('ALTER TABLE social_network ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE social_network ALTER uuid TYPE UUID');
    
        $this->addSql('COMMENT ON COLUMN social_network.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFFF5221D17F50A6 ON social_network (uuid)');
        $this->addSql('ALTER TABLE subject ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE technology ALTER id DROP DEFAULT');
        $this->addSql('ALTER INDEX uniq_name RENAME TO UNIQ_F463524D5E237E06');
        $this->addSql('ALTER TABLE technology_type ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
        $this->addSql('ALTER INDEX uniq_email RENAME TO UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER INDEX uniq_username RENAME TO UNIQ_IDENTIFIER_USERNAME');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE degree_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE experience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_network_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('ALTER INDEX uniq_identifier_username RENAME TO uniq_username');
        $this->addSql('ALTER INDEX uniq_8d93d649e7927c74 RENAME TO uniq_email');

        $this->addSql('ALTER TABLE technology_type ALTER id SET DEFAULT nextval(\'technology_type_id_seq\')');

        $this->addSql('ALTER TABLE degree ALTER uuid TYPE UUID');
        $this->addSql('ALTER TABLE degree ALTER uuid SET DEFAULT gen_random_uuid()');
        $this->addSql('COMMENT ON COLUMN degree.uuid IS NULL');
        $this->addSql('ALTER INDEX uniq_a7a36d63d17f50a6 RENAME TO uniq_uuid');

        $this->addSql('ALTER INDEX uniq_f83c5f4477153098 RENAME TO uniq_code');

        $this->addSql('ALTER TABLE experience ALTER uuid TYPE UUID');
        $this->addSql('ALTER TABLE experience ALTER uuid SET DEFAULT gen_random_uuid()');
        $this->addSql('COMMENT ON COLUMN experience.uuid IS NULL');

        $this->addSql('ALTER INDEX uniq_f463524d5e237e06 RENAME TO uniq_name');
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT FK_1BC2EDF146E90E27');
        $this->addSql('ALTER TABLE experience_technology DROP CONSTRAINT FK_1BC2EDF14235D463');

        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview DROP DEFAULT');
        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview  TYPE SMALLINT USING CASE WHEN show_in_overview = TRUE THEN 1 ELSE 0 END;');
        $this->addSql('ALTER TABLE experience_technology ALTER show_in_overview SET DEFAULT 1');

        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT fk_experience_id FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience_technology ADD CONSTRAINT fk_technology_id FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX UNIQ_EFFF5221D17F50A6');

        $this->addSql('ALTER TABLE social_network ALTER uuid TYPE UUID');
        $this->addSql('ALTER TABLE social_network ALTER uuid SET DEFAULT gen_random_uuid()');
        $this->addSql('COMMENT ON COLUMN social_network.uuid IS NULL');

        $this->addSql('DROP INDEX UNIQ_2FB3D0EED17F50A6');

        $this->addSql('ALTER TABLE project ALTER uuid TYPE UUID');
        $this->addSql('ALTER TABLE project ALTER uuid SET DEFAULT gen_random_uuid()');
        $this->addSql('COMMENT ON COLUMN project.uuid IS NULL');
    }
}
