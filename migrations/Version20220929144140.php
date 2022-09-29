<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929144140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, pages_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, page_to_redirect INT NOT NULL, INDEX IDX_C1AB5A92401ADD27 (pages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, title VARCHAR(128) NOT NULL, image VARCHAR(2083) NOT NULL, content LONGTEXT NOT NULL, start LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', page_end INT NOT NULL, INDEX IDX_140AB620AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(2083) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nickname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_story (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, stories_id INT NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_994FF6067B3B43D (users_id), INDEX IDX_994FF60BF2402DE (stories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92401ADD27 FOREIGN KEY (pages_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_story ADD CONSTRAINT FK_994FF6067B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_story ADD CONSTRAINT FK_994FF60BF2402DE FOREIGN KEY (stories_id) REFERENCES story (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92401ADD27');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620AA5D4036');
        $this->addSql('ALTER TABLE user_story DROP FOREIGN KEY FK_994FF6067B3B43D');
        $this->addSql('ALTER TABLE user_story DROP FOREIGN KEY FK_994FF60BF2402DE');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_story');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
