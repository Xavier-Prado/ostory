<?php

namespace App\Entity;

use App\Repository\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ChoiceRepository::class)
 */
class Choice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"page_content"})
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"page_content"})
     * 
     */
    private $page_id;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="choices", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $pages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    public function setPageId(int $page_id): self
    {
        $this->page_id = $page_id;

        return $this;
    }

    public function getPages(): ?Page
    {
        return $this->pages;
    }

    public function setPages(?Page $pages): self
    {
        $this->pages = $pages;

        return $this;
    }
}
