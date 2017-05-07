<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="dataNaixament", type="date", nullable=true)
     */
    private $dataNaixament;

    /**
     * @var string
     *
     * @ORM\Column(name="nif", type="string", length=255, nullable=true)
     */
    private $nif;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="Client")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;


   

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
     * @return Client
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
     * @return Client
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
     * Set dataNaixament
     *
     * @param \DateTime $dataNaixament
     *
     * @return Client
     */
    public function setDataNaixament($dataNaixament)
    {
        $this->dataNaixament = $dataNaixament;
    
        return $this;
    }

    /**
     * Get dataNaixament
     *
     * @return \DateTime
     */
    public function getDataNaixament()
    {
        return $this->dataNaixament;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return Client
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
     * Set user
     *
     * @param \HotelBundle\Entity\User $user
     *
     * @return Client
     */
    public function setUser(\HotelBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \HotelBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
