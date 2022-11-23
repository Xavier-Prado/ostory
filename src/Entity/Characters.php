<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;




/**
 * @ORM\Entity(repositoryClass=CharactersRepository::class)
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Ce nom est déjà utilisé"
 * )
 */
class Characters
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"characters_list"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner un nom pour le personnage")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom du personnage doit faire au moins {{ limit }} caractères !",
     *      maxMessage = "Le nom du personnage ne doit pas faire plus de {{ limit }} caractères !"
     * )
     * @Groups({"characters_list"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2083)
     * @Groups({"characters_list"})
     * 
     */
    private $image;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
