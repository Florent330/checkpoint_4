<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRepository")
 * @ORM\Table("`show`")
 */
class Show
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="shows")
     */
    private $artistes;

    public function __construct ()
    {
        $this->artistes = new ArrayCollection();
    }

    public function getId (): ?int
    {
        return $this->id;
    }

    public function getDate (): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate ( \DateTimeInterface $date ): self
    {
        $this->date = $date;

        return $this;
    }

    public function getName (): ?string
    {
        return $this->name;
    }

    public function setName ( string $name ): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription (): ?string
    {
        return $this->description;
    }

    public function setDescription ( ?string $description ): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture (): ?string
    {
        return $this->picture;
    }

    public function setPicture ( ?string $picture ): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getArtistes (): Collection
    {
        return $this->artistes;
    }

    public function addArtiste ( User $artiste ): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
        }

        return $this;
    }

    public function removeArtiste ( User $artiste ): self
    {
        if ($this->artistes->contains($artiste)) {
            $this->artistes->removeElement($artiste);
        }

        return $this;
    }
}
