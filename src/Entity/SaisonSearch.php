<?php

namespace App\Entity;




class SaisonSearch
{

    /**
     * @var Saison|null
     */
    private $saison;

    /**
     * @return Saison|null
     */
    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    /**
     * @param Saison|null $saison
     */
    public function setSaison(?Saison $saison): void
    {
        $this->saison = $saison;
    }




    public function __construct()
    {
    }


}