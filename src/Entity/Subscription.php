<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $duration_in_month = null;

    /**
     * @var Collection<int, subscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: subscriptionHistory::class, mappedBy: 'subscription')]
    private Collection $history;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'currentSubscription')]
    private Collection $users;

    public function __construct()
    {
        $this->history = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDurationInMonth(): ?int
    {
        return $this->duration_in_month;
    }

    public function setDurationInMonth(int $duration_in_month): static
    {
        $this->duration_in_month = $duration_in_month;

        return $this;
    }

    /**
     * @return Collection<int, subscriptionHistory>
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(subscriptionHistory $history): static
    {
        if (!$this->history->contains($history)) {
            $this->history->add($history);
            $history->setSubscription($this);
        }

        return $this;
    }

    public function removeHistory(subscriptionHistory $history): static
    {
        if ($this->history->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getSubscription() === $this) {
                $history->setSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCurrentSubscription($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCurrentSubscription() === $this) {
                $user->setCurrentSubscription(null);
            }
        }

        return $this;
    }
}
