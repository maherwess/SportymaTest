<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * Un club peut changer le logo plusieurs fois
     * @ORM\OneToMany(targetEntity="Logo", mappedBy="club", cascade={"persist","remove"})
     */
    private $logos;


    /**
     * Plusieurs Clubs ont Plusieurs joueurs.
     * @ORM\ManyToMany(targetEntity="Joueur", mappedBy="clubs", cascade={"persist","remove"})
     */
    private $joueurs;


    /**
     * Plusieurs historiques pour un seul joueur
     * @ORM\ManyToOne(targetEntity="Joueur", inversedBy="historiques")
     * @ORM\JoinColumn(name="joueur_id", referencedColumnName="id")
     */
    private $joueur;

    /**
     * Plusieurs Clubs ont Plusieurs saisons.
     * @ORM\ManyToMany(targetEntity="Saison", mappedBy="clubs", cascade={"persist","remove"})
     */
    private $saisons;



    public function __construct()
    {
        $this->joueurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->saisons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->logos = new \Doctrine\Common\Collections\ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


    /**
     * @return Collection|Joueur[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->addClub($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->contains($joueur)) {
            $this->joueurs->removeElement($joueur);
            $joueur->removeClub($this);
        }

        return $this;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons[] = $saison;
            $saison->addClub($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->saisons->contains($saison)) {
            $this->saisons->removeElement($saison);
            $saison->removeClub($this);
        }

        return $this;
    }

    /**
     * @return Collection|Logo[]
     */
    public function getLogos(): Collection
    {
        return $this->logos;
    }

    public function addLogo(Logo $logo): self
    {
        if (!$this->logos->contains($logo)) {
            $this->logos[] = $logo;
            $logo->setClub($this);
        }

        return $this;
    }

    public function removeLogo(Logo $logo): self
    {
        if ($this->logos->contains($logo)) {
            $this->logos->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getClub() === $this) {
                $logo->setClub(null);
            }
        }

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

}
