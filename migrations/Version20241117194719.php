<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117194719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE author author BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE playlist CHANGE author_id author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE user_playlist_subscription_id user_playlist_subscription_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE subscription_history CHANGE user_subscription_history_id user_subscription_history_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE user CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE watch_history CHANGE user_history_id user_history_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription_history CHANGE user_subscription_history_id user_subscription_history_id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE id id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE playlist CHANGE author_id author_id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE watch_history CHANGE user_history_id user_history_id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE author author BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE user_playlist_subscription_id user_playlist_subscription_id BINARY(16) NOT NULL');
    }
}
