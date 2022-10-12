<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StoryRepository::class)
 */
class Story
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"story_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le titre doit faire au moins {{ limit }} caractères !",
     *      maxMessage = "Le titre ne doit pas faire plus de {{ limit }} caractères !"
     * )
     * @Groups({"story_list"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le contenu doit faire au moins {{ limit }} caractères !",
     * )
     * @Groups({"story_list"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"story_list"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=2083)
     * @Assert\NotBlank
     * @Assert\Url(
     *    protocols = {"http", "https"}
     * )
     * @Groups({"story_list"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=UserStory::class, mappedBy="stories", orphanRemoval=true)
     */
    private $userStories;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="story")
     * 
     */
    private $pages;

    /**
     * @Groups({"story_list"})
     */
    private $startPage;

    public function __construct()
    {
        $this->userStories = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, UserStory>
     */
    public function getUserStories(): Collection
    {
        return $this->userStories;
    }

    public function addUserStory(UserStory $userStory): self
    {
        if (!$this->userStories->contains($userStory)) {
            $this->userStories[] = $userStory;
            $userStory->setStories($this);
        }

        return $this;
    }

    public function removeUserStory(UserStory $userStory): self
    {
        if ($this->userStories->removeElement($userStory)) {
            // set the owning side to null (unless already changed)
            if ($userStory->getStories() === $this) {
                $userStory->setStories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setStory($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getStory() === $this) {
                $page->setStory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getStartPage()
    {
        $pages = $this->getPages();
        foreach($pages as $page) {
            // if it has start value, it's id will be added to the $storyList array
            // at the 'start_page' key
            if($page->isStart()) {
                return $page->getId();
            }
        }
    }
}
