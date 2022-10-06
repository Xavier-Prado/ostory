<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Form\PageType;


/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 128,
     *      minMessage = "Le titre doit faire au moins {{ limit }} caractères !",
     *      maxMessage = "Le titre ne doit pas faire plus de {{ limit }} caractères !"
     * )
     * @Groups({"page_content"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2083)
     * @Assert\NotBlank
     * @Assert\Url(
     *    protocols = {"http", "https"}
     * )
     * @Groups({"page_content"})
     * 
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le contenu doit faire au moins {{ limit }} caractères !",
     * )
     * @Groups({"page_content"})
     * 
     */
    private $content;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Assert\NotNull
     * @Assert\Choice(choices=PageType::START)
     * 
     */
    private $start;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Groups({"page_content"})
     * 
     */
    private $page_end;

    /**
     * @ORM\ManyToOne(targetEntity=Story::class, inversedBy="pages")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $story;

    /**
     * @ORM\OneToMany(targetEntity=Choice::class, mappedBy="pages")
     * @Groups({"page_content"})
     * 
     */
    private $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function isStart(): ?bool
    {
        return $this->start;
    }

    public function setStart(?bool $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getPageEnd(): ?int
    {
        return $this->page_end;
    }

    public function setPageEnd(?int $page_end): self
    {
        $this->page_end = $page_end;

        return $this;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): self
    {
        $this->story = $story;

        return $this;
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
            $choice->setPages($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getPages() === $this) {
                $choice->setPages(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
