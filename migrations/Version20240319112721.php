<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319112721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE allergene_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE avis_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "table_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE allergene (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE avis (id INT NOT NULL, utilisateur_id INT DEFAULT NULL, restaurant_id INT DEFAULT NULL, note DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, interaction INT NOT NULL, date_avis TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F91ABF0FB88E14F ON avis (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0B1E7706E ON avis (restaurant_id)');
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commande (id INT NOT NULL, restaurant_id INT NOT NULL, utilisateur_id INT NOT NULL, clickncollect BOOLEAN NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB1E7706E ON commande (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFB88E14F ON commande (utilisateur_id)');
        $this->addSql('CREATE TABLE commande_plat (commande_id INT NOT NULL, plat_id INT NOT NULL, PRIMARY KEY(commande_id, plat_id))');
        $this->addSql('CREATE INDEX IDX_4B54A3E482EA2E54 ON commande_plat (commande_id)');
        $this->addSql('CREATE INDEX IDX_4B54A3E4D73DB560 ON commande_plat (plat_id)');
        $this->addSql('CREATE TABLE plat (id INT NOT NULL, categorie_id INT NOT NULL, restaurant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, photo VARCHAR(255) DEFAULT NULL, clickncollect BOOLEAN NOT NULL, plat_du_jour BOOLEAN NOT NULL, specialite BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2038A207BCF5E72D ON plat (categorie_id)');
        $this->addSql('CREATE INDEX IDX_2038A207B1E7706E ON plat (restaurant_id)');
        $this->addSql('CREATE TABLE plat_allergene (plat_id INT NOT NULL, allergene_id INT NOT NULL, PRIMARY KEY(plat_id, allergene_id))');
        $this->addSql('CREATE INDEX IDX_6FA44BBFD73DB560 ON plat_allergene (plat_id)');
        $this->addSql('CREATE INDEX IDX_6FA44BBF4646AB2 ON plat_allergene (allergene_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, utilisateur_id INT DEFAULT NULL, restaurant_id INT NOT NULL, table_select_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nb_personnes INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955FB88E14F ON reservation (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B1E7706E ON reservation (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_42C84955868FB497 ON reservation (table_select_id)');
        $this->addSql('CREATE INDEX IDX_42C8495582EA2E54 ON reservation (commande_id)');
        $this->addSql('CREATE TABLE "table" (id INT NOT NULL, restaurant_id INT NOT NULL, nb_place INT NOT NULL, disponible BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F6298F46B1E7706E ON "table" (restaurant_id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_plat ADD CONSTRAINT FK_4B54A3E482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commande_plat ADD CONSTRAINT FK_4B54A3E4D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plat_allergene ADD CONSTRAINT FK_6FA44BBFD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plat_allergene ADD CONSTRAINT FK_6FA44BBF4646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955868FB497 FOREIGN KEY (table_select_id) REFERENCES "table" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "table" ADD CONSTRAINT FK_F6298F46B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE allergene_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE avis_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "table_id_seq" CASCADE');
        $this->addSql('ALTER TABLE avis DROP CONSTRAINT FK_8F91ABF0FB88E14F');
        $this->addSql('ALTER TABLE avis DROP CONSTRAINT FK_8F91ABF0B1E7706E');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67DB1E7706E');
        $this->addSql('ALTER TABLE commande DROP CONSTRAINT FK_6EEAA67DFB88E14F');
        $this->addSql('ALTER TABLE commande_plat DROP CONSTRAINT FK_4B54A3E482EA2E54');
        $this->addSql('ALTER TABLE commande_plat DROP CONSTRAINT FK_4B54A3E4D73DB560');
        $this->addSql('ALTER TABLE plat DROP CONSTRAINT FK_2038A207BCF5E72D');
        $this->addSql('ALTER TABLE plat DROP CONSTRAINT FK_2038A207B1E7706E');
        $this->addSql('ALTER TABLE plat_allergene DROP CONSTRAINT FK_6FA44BBFD73DB560');
        $this->addSql('ALTER TABLE plat_allergene DROP CONSTRAINT FK_6FA44BBF4646AB2');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955FB88E14F');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955B1E7706E');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955868FB497');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495582EA2E54');
        $this->addSql('ALTER TABLE "table" DROP CONSTRAINT FK_F6298F46B1E7706E');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_plat');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE plat_allergene');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE "table"');
    }
}
