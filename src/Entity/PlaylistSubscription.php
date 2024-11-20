<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $subscribed_at = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscription')]
    #[ORM\JoinColumn(name: 'user_playlist_subscription_id')]
    private ?User $userPlaylistSubscription = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscription')]
    private ?Playlist $playlist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscribedAt(): ?\DateTimeImmutable
    {
        return $this->subscribed_at;
    }

    public function setSubscribedAt(\DateTimeImmutable $subscribed_at): static
    {
        $this->subscribed_at = $subscribed_at;

        return $this;
    }

    public function getUserPlaylistSubscription(): ?User
    {
        return $this->userPlaylistSubscription;
    }

    public function setUserPlaylistSubscription(?User $userPlaylistSubscription): static
    {
        $this->userPlaylistSubscription = $userPlaylistSubscription;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }
}
