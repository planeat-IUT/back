<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131143246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD complement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD code_postal VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD siret VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD longitude DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD latitude DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD telephone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD rib VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD nb_table INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD a_decouvrir BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE restaurant DROP complement');
        $this->addSql('ALTER TABLE restaurant DROP code_postal');
        $this->addSql('ALTER TABLE restaurant DROP siret');
        $this->addSql('ALTER TABLE restaurant DROP longitude');
        $this->addSql('ALTER TABLE restaurant DROP latitude');
        $this->addSql('ALTER TABLE restaurant DROP mail');
        $this->addSql('ALTER TABLE restaurant DROP telephone');
        $this->addSql('ALTER TABLE restaurant DROP rib');
        $this->addSql('ALTER TABLE restaurant DROP logo');
        $this->addSql('ALTER TABLE restaurant DROP nb_table');
        $this->addSql('ALTER TABLE restaurant DROP a_decouvrir');
    }
}
