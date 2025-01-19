<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116172252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS guitar_tabs');
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guitar_tab (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, artist VARCHAR(255) DEFAULT NULL, capo SMALLINT NOT NULL, uploaded_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , content CLOB NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guitar_tabs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY", artist VARCHAR(255) DEFAULT NULL COLLATE "BINARY", capo SMALLINT NOT NULL, uploaded_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('DROP TABLE guitar_tab');
    }
}
