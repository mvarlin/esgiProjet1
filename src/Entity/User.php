<?php

namespace App\Entity;

use App\Enum\UserAccountStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(enumType: UserAccountStatusEnum::class)]
    private ?UserAccountStatusEnum $account_status = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'author')]
    private Collection $comments;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'author')]
    private Collection $playlists;

    #[ORM\ManyToOne(inversedBy: 'subscription')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subscription $subscription = null;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'userPlaylistSubscription')]
    private Collection $playlistSubscription;

    /**
     * @var Collection<int, WatchHistory>
     */
    #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'userHistory')]
    private Collection $history;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->playlistSubscription = new ArrayCollection();
        $this->history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAccountStatus(): ?UserAccountStatusEnum
    {
        return $this->account_status;
    }

    public function setAccountStatus(UserAccountStatusEnum $account_status): static
    {
        $this->account_status = $account_status;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setAuthor($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getAuthor() === $this) {
                $playlist->setAuthor(null);
            }
        }

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): static
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscription(): Collection
    {
        return $this->playlistSubscription;
    }

    public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if (!$this->playlistSubscription->contains($playlistSubscription)) {
            $this->playlistSubscription->add($playlistSubscription);
            $playlistSubscription->setUserPlaylistSubscription($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if ($this->playlistSubscription->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getUserPlaylistSubscription() === $this) {
                $playlistSubscription->setUserPlaylistSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchHistory>
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(WatchHistory $history): static
    {
        if (!$this->history->contains($history)) {
            $this->history->add($history);
            $history->setUserHistory($this);
        }

        return $this;
    }

    public function removeHistory(WatchHistory $history): static
    {
        if ($this->history->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getUserHistory() === $this) {
                $history->setUserHistory(null);
            }
        }

        return $this;
    }
}
