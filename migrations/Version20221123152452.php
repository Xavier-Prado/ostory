<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123152452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_story DROP FOREIGN KEY FK_994FF6067B3B43D');
        $this->addSql('ALTER TABLE user_story DROP FOREIGN KEY FK_994FF60BF2402DE');
        $this->addSql('DROP TABLE user_story');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_story (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, stories_id INT NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_994FF60BF2402DE (stories_id), INDEX IDX_994FF6067B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_story ADD CONSTRAINT FK_994FF6067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_story ADD CONSTRAINT FK_994FF60BF2402DE FOREIGN KEY (stories_id) REFERENCES story (id)');
    }
}
