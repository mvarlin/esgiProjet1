<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?media $media = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedia(): ?media
    {
        return $this->media;
    }

    public function setMedia(media $media): static
    {
        $this->media = $media;

        return $this;
    }
}
