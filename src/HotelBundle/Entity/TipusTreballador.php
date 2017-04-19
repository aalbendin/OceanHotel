<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipusTreballador
 *
 * @ORM\Table(name="tipus_treballador")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TipusTreballadorRepository")
 */
class TipusTreballador
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
     * @return TipusTreballador
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

