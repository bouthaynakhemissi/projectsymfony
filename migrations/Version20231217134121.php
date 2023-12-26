<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217134121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, heure_debut DATE NOT NULL, heure_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emplacement ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F6B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_C0CF65F6B83297E7 ON emplacement (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455B83297E7');
        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F6B83297E7');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP INDEX IDX_C0CF65F6B83297E7 ON emplacement');
        $this->addSql('ALTER TABLE emplacement DROP reservation_id');
    }
}
