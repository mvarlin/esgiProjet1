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
     * @var Collection<int, user>
     */
    #[ORM\OneToMany(targetEntity: user::class, mappedBy: 'subscription')]
    private Collection $subscription;

    /**
     * @var Collection<int, subscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: subscriptionHistory::class, mappedBy: 'subscription')]
    private Collection $history;

    public function __construct()
    {
        $this->subscription = new ArrayCollection();
        $this->history = new ArrayCollection();
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
     * @return Collection<int, user>
     */
    public function getSubscription(): Collection
    {
        return $this->subscription;
    }

    public function addSubscription(user $subscription): static
    {
        if (!$this->subscription->contains($subscription)) {
            $this->subscription->add($subscription);
            $subscription->setSubscription($this);
        }

        return $this;
    }

    public function removeSubscription(user $subscription): static
    {
        if ($this->subscription->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getSubscription() === $this) {
                $subscription->setSubscription(null);
            }
        }

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
}
