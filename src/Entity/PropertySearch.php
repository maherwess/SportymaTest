<?php

namespace App\Entity;




class PropertySearch
{

    /**
     * @var \DateTime|null
     */
    private $dateDebut;


    /**
     * @var \DateTime|null
     */
    private $dateFin;

    /**
     * @return null|\DateTime
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param null|\DateTime $dateDebut
     */
    public function setDateDebut(?\DateTime $dateDebut): PropertySearch
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param null|\DateTime $dateFin
     */
    public function setDateFin(?\DateTime $dateFin): PropertySearch
    {
        $this->dateFin = $dateFin;
        return $this;
    }


    public function __construct()
    {
    }


}