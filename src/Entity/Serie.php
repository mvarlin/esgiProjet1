<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?media $media = null;

    /**
     * @var Collection<int, season>
     */
    #[ORM\OneToMany(targetEntity: season::class, mappedBy: 'serie')]
    private Collection $season;

    public function __construct()
    {
        $this->season = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, season>
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(season $season): static
    {
        if (!$this->season->contains($season)) {
            $this->season->add($season);
            $season->setSerie($this);
        }

        return $this;
    }

    public function removeSeason(season $season): static
    {
        if ($this->season->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getSerie() === $this) {
                $season->setSerie(null);
            }
        }

        return $this;
    }
}
