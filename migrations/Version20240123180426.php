<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123180426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_category ADD content_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE service_category ADD CONSTRAINT FK_FF3A42FC9487CA85 FOREIGN KEY (content_id_id) REFERENCES content (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF3A42FC9487CA85 ON service_category (content_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_category DROP FOREIGN KEY FK_FF3A42FC9487CA85');
        $this->addSql('DROP INDEX UNIQ_FF3A42FC9487CA85 ON service_category');
        $this->addSql('ALTER TABLE service_category DROP content_id_id');
    }
}
