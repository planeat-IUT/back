<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318144459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD click_collect BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD type TEXT NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN restaurant.type IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE restaurant DROP click_collect');
        $this->addSql('ALTER TABLE restaurant DROP type');
        $this->addSql('ALTER TABLE restaurant DROP prix');
    }
}
