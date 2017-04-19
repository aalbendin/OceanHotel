<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modalitat
 *
 * @ORM\Table(name="modalitat")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\ModalitatRepository")
 */
class Modalitat
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
     * @ORM\Column(name="descripcio", type="string", length=255, nullable=true)
     */
    private $descripcio;

    /**
     * @var string
     *
     * @ORM\Column(name="preu", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $preu;


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
     * Set descripcio
     *
     * @param string $descripcio
     *
     * @return Modalitat
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;
    
        return $this;
    }

    /**
     * Get descripcio
     *
     * @return string
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Set preu
     *
     * @param string $preu
     *
     * @return Modalitat
     */
    public function setPreu($preu)
    {
        $this->preu = $preu;
    
        return $this;
    }

    /**
     * Get preu
     *
     * @return string
     */
    public function getPreu()
    {
        return $this->preu;
    }
}

