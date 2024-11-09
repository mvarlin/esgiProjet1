<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Edit relations between Media, PlaylistMedia, PlaylistSubscription and WatchHistory
 */
final class Version20241109034531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C6BBD148');
        $this->addSql('DROP INDEX IDX_6A2CA10C6BBD148 ON media');
        $this->addSql('ALTER TABLE media DROP playlist_id');
        $this->addSql('ALTER TABLE playlist_media ADD media_id INT DEFAULT NULL, ADD playlist_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_C930B84FEA9FDD75 ON playlist_media (media_id)');
        $this->addSql('CREATE INDEX IDX_C930B84F6BBD148 ON playlist_media (playlist_id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD playlist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_832940C6BBD148 ON playlist_subscription (playlist_id)');
        $this->addSql('ALTER TABLE watch_history ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8EA9FDD75 ON watch_history (media_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD playlist_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A2CA10C6BBD148 ON media (playlist_id)');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FEA9FDD75');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F6BBD148');
        $this->addSql('DROP INDEX IDX_C930B84FEA9FDD75 ON playlist_media');
        $this->addSql('DROP INDEX IDX_C930B84F6BBD148 ON playlist_media');
        $this->addSql('ALTER TABLE playlist_media DROP media_id, DROP playlist_id');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('DROP INDEX IDX_832940C6BBD148 ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription DROP playlist_id');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP INDEX IDX_DE44EFD8EA9FDD75 ON watch_history');
        $this->addSql('ALTER TABLE watch_history DROP media_id');
    }
}
