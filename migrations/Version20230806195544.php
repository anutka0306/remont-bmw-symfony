<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230806195544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content ADD brand_id INT DEFAULT NULL, ADD model_id INT DEFAULT NULL, ADD submodel_id INT DEFAULT NULL, ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A97975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A972E50A6E FOREIGN KEY (submodel_id) REFERENCES submodel (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A944F5D008 ON content (brand_id)');
        $this->addSql('CREATE INDEX IDX_FEC530A97975B7E7 ON content (model_id)');
        $this->addSql('CREATE INDEX IDX_FEC530A972E50A6E ON content (submodel_id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9ED5CA9E6 ON content (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A944F5D008');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A97975B7E7');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A972E50A6E');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_FEC530A944F5D008 ON content');
        $this->addSql('DROP INDEX IDX_FEC530A97975B7E7 ON content');
        $this->addSql('DROP INDEX IDX_FEC530A972E50A6E ON content');
        $this->addSql('DROP INDEX IDX_FEC530A9ED5CA9E6 ON content');
        $this->addSql('ALTER TABLE content DROP brand_id, DROP model_id, DROP submodel_id, DROP service_id');
    }
}
