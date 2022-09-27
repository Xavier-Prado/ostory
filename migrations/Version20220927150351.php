<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927150351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92401ADD27');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92401ADD27 FOREIGN KEY (pages_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY page_ibfk_2');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620AA5D4036');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT page_ibfk_2 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92401ADD27');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92401ADD27 FOREIGN KEY (pages_id) REFERENCES page (id)');
    }
}
