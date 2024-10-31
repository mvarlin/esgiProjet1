<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class WatchHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateInterval $last_watched = null;

    #[ORM\Column]
    private ?int $number_of_views = null;

    #[ORM\ManyToOne(inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userHistory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWatched(): ?\DateInterval
    {
        return $this->last_watched;
    }

    public function setLastWatched(\DateInterval $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->number_of_views;
    }

    public function setNumberOfViews(int $number_of_views): static
    {
        $this->number_of_views = $number_of_views;

        return $this;
    }

    public function getUserHistory(): ?User
    {
        return $this->userHistory;
    }

    public function setUserHistory(?User $userHistory): static
    {
        $this->userHistory = $userHistory;

        return $this;
    }
}
