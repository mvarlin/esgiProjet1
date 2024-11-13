<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add relation between SubscriptionHistory and User
 */
final class Version20241111020220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription_history ADD user_subscription_history_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D065316D66 FOREIGN KEY (user_subscription_history_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_54AF90D065316D66 ON subscription_history (user_subscription_history_id)');
        $this->addSql('ALTER TABLE watch_history CHANGE last_watched last_watched DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D065316D66');
        $this->addSql('DROP INDEX IDX_54AF90D065316D66 ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history DROP user_subscription_history_id');
        $this->addSql('ALTER TABLE watch_history CHANGE last_watched last_watched VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
    }
}
