<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320164354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_utilisateur (restaurant_id INT NOT NULL, utilisateur_id INT NOT NULL, PRIMARY KEY(restaurant_id, utilisateur_id))');
        $this->addSql('CREATE INDEX IDX_4C6759A9B1E7706E ON restaurant_utilisateur (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_4C6759A9FB88E14F ON restaurant_utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE restaurant_utilisateur ADD CONSTRAINT FK_4C6759A9B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE restaurant_utilisateur ADD CONSTRAINT FK_4C6759A9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE restaurant_utilisateur DROP CONSTRAINT FK_4C6759A9B1E7706E');
        $this->addSql('ALTER TABLE restaurant_utilisateur DROP CONSTRAINT FK_4C6759A9FB88E14F');
        $this->addSql('DROP TABLE restaurant_utilisateur');
    }
}
