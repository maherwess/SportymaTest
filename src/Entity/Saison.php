<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaisonRepository::class)
 */
class Saison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneedebut;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneefin;

    /**
     * Pusieurs Saisons contiennent plusieurs Club
     * @ORM\ManyToMany(targetEntity="Club", inversedBy="saisons", cascade={"persist","remove"})
     * @ORM\JoinTable(name="saisons_clubs")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|Club[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->removeElement($club);
        }

        return $this;
    }

    public function getAnneedebut(): ?int
    {
        return $this->anneedebut;
    }

    public function setAnneedebut(int $anneedebut): self
    {
        $this->anneedebut = $anneedebut;

        return $this;
    }

    public function getAnneefin(): ?int
    {
        return $this->anneefin;
    }

    public function setAnneefin(int $anneefin): self
    {
        $this->anneefin = $anneefin;

        return $this;
    }

    public function __toString()
    {
        return $this->anneedebut .'/'. $this->anneefin ;
    }
}
