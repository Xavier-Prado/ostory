<?php

namespace App\Entity;

use App\Repository\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Groups({"page_content"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de la page doit faire au moins {{ limit }} caractères !",
     *      maxMessage = "Le nom de la page ne doit pas faire plus de {{ limit }} caractères !"
     * )
     * @Groups({"page_content"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "La description doit faire au moins {{ limit }} caractères !",
     * )
     * @Groups({"page_content"})
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"page_content"})
     * 
     */
    private $page_to_redirect;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="choices")
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

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * Get the value of page_to_redirect
     */ 
    public function getPageToRedirect()
    {
        return $this->page_to_redirect;
    }

    /**
     * Set the value of page_to_redirect
     *
     * @return  self
     */ 
    public function setPageToRedirect($page_to_redirect)
    {
        $this->page_to_redirect = $page_to_redirect;

        return $this;
    }

}
