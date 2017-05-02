<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipusHabitacio
 *
 * @ORM\Table(name="tipus_habitacio")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TipusHabitacioRepository")
 */
class TipusHabitacio
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
     * @ORM\Column(name="imatge", type="string", length=255, nullable=true)
     */
    private $imatge;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcio", type="string", length=255, nullable=true)
     */
    private $descripcio;



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
     * Set imatge
     *
     * @param string $imatge
     *
     * @return TipusHabitacio
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    
        return $this;
    }

    /**
     * Get imatge
     *
     * @return string
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * Set descripcio
     *
     * @param string $descripcio
     *
     * @return TipusHabitacio
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
}
