<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510194818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD COLUMN company VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__adresse AS SELECT id, contact_name, photo, ville_residence, telephone, telephone2, email, nationalite, boite_postale, sexe, details, created_at FROM adresse');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('CREATE TABLE adresse (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_name VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, ville_residence VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, telephone2 VARCHAR(20) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, nationalite VARCHAR(100) NOT NULL, boite_postale VARCHAR(100) NOT NULL, sexe VARCHAR(20) NOT NULL, details CLOB DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO adresse (id, contact_name, photo, ville_residence, telephone, telephone2, email, nationalite, boite_postale, sexe, details, created_at) SELECT id, contact_name, photo, ville_residence, telephone, telephone2, email, nationalite, boite_postale, sexe, details, created_at FROM __temp__adresse');
        $this->addSql('DROP TABLE __temp__adresse');
    }
}
