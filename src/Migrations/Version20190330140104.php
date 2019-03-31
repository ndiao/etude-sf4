<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330140104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien ADD surface INT NOT NULL, ADD pieces INT NOT NULL, ADD chambres INT NOT NULL, ADD etage INT NOT NULL, ADD climatisation INT NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD vendu TINYINT(1) DEFAULT \'0\' NOT NULL, ADD date_creation DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien DROP surface, DROP pieces, DROP chambres, DROP etage, DROP climatisation, DROP ville, DROP adresse, DROP vendu, DROP date_creation');
    }
}
