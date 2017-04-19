<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Treballador
 *
 * @ORM\Table(name="treballador")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TreballadorRepository")
 */
class Treballador
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cognoms", type="string", length=255, nullable=true)
     */
    private $cognoms;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataNaiximent", type="date", nullable=true)
     */
    private $dataNaiximent;

    /**
     * @var string
     *
     * @ORM\Column(name="nif", type="string", length=255, nullable=true)
     */
    private $nif;

    /**
     * @var int
     *
     * @ORM\Column(name="usuari", type="integer", nullable=true)
     */
    private $usuari;

    /**
     * @var int
     *
     * @ORM\Column(name="tipusTreballador", type="integer", nullable=true)
     */
    private $tipusTreballador;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Treballador
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cognoms
     *
     * @param string $cognoms
     *
     * @return Treballador
     */
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    
        return $this;
    }

    /**
     * Get cognoms
     *
     * @return string
     */
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * Set dataNaiximent
     *
     * @param \DateTime $dataNaiximent
     *
     * @return Treballador
     */
    public function setDataNaiximent($dataNaiximent)
    {
        $this->dataNaiximent = $dataNaiximent;
    
        return $this;
    }

    /**
     * Get dataNaiximent
     *
     * @return \DateTime
     */
    public function getDataNaiximent()
    {
        return $this->dataNaiximent;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return Treballador
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    
        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set usuari
     *
     * @param integer $usuari
     *
     * @return Treballador
     */
    public function setUsuari($usuari)
    {
        $this->usuari = $usuari;
    
        return $this;
    }

    /**
     * Get usuari
     *
     * @return integer
     */
    public function getUsuari()
    {
        return $this->usuari;
    }

    /**
     * Set tipusTreballador
     *
     * @param integer $tipusTreballador
     *
     * @return Treballador
     */
    public function setTipusTreballador($tipusTreballador)
    {
        $this->tipusTreballador = $tipusTreballador;
    
        return $this;
    }

    /**
     * Get tipusTreballador
     *
     * @return integer
     */
    public function getTipusTreballador()
    {
        return $this->tipusTreballador;
    }
}

