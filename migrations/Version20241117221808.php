<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117221808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE author_id author_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE playlist CHANGE author_id author_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE user_playlist_subscription_id user_playlist_subscription_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE subscription_history CHANGE user_subscription_history_id user_subscription_history_id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id CHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE watch_history CHANGE user_history_id user_history_id CHAR(36) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription_history CHANGE user_subscription_history_id user_subscription_history_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE `user` CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE playlist CHANGE author_id author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE watch_history CHANGE user_history_id user_history_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment CHANGE author_id author_id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE user_playlist_subscription_id user_playlist_subscription_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }
}
