<?php

namespace App\Entity;

use App\Repository\UserStoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserStoryRepository::class)
 */
class UserStory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $start_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userStories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Story::class, inversedBy="userStories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeImmutable $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getStories(): ?Story
    {
        return $this->stories;
    }

    public function setStories(?Story $stories): self
    {
        $this->stories = $stories;

        return $this;
    }
}
