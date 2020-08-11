<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
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
     * @ORM\Column(type="string", length=255)
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * Pusieurs Joueurs jouent à plusieurs Club
     * @ORM\ManyToMany(targetEntity="Club", inversedBy="joueurs", cascade={"persist","remove"})
     * @ORM\JoinTable(name="joueurs_clubs")
     */
    private $clubs;


    /**
     * Un joueur à plusieurs historiques d'équipes
     * @ORM\OneToMany(targetEntity="Club", mappedBy="joueur")
     */
    private $historiques;

    /**
     * un joueurs a plusieurs buts.
     * @ORM\OneToMany(targetEntity="But", mappedBy="joueur")
     */
    private $buts;

    public function __construct()
    {
        $this->clubs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->buts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->historiques = new \Doctrine\Common\Collections\ArrayCollection();

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

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    /**
     * @return Collection|But[]
     */
    public function getButs(): Collection
    {
        return $this->buts;
    }

    public function addBut(But $but): self
    {
        if (!$this->buts->contains($but)) {
            $this->buts[] = $but;
            $but->setJoueur($this);
        }

        return $this;
    }

    public function removeBut(But $but): self
    {
        if ($this->buts->contains($but)) {
            $this->buts->removeElement($but);
            // set the owning side to null (unless already changed)
            if ($but->getJoueur() === $this) {
                $but->setJoueur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getPrenom() .' '. $this->getNom();
    }

    /**
     * @return Collection|Club[]
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Club $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setJoueur($this);
        }

        return $this;
    }

    public function removeHistorique(Club $historique): self
    {
        if ($this->historiques->contains($historique)) {
            $this->historiques->removeElement($historique);
            // set the owning side to null (unless already changed)
            if ($historique->getJoueur() === $this) {
                $historique->setJoueur(null);
            }
        }

        return $this;
    }
}
