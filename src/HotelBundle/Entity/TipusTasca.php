<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipusTasca
 *
 * @ORM\Table(name="tipus_tasca")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TipusTascaRepository")
 */
class TipusTasca
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
     * @ORM\ManyToOne(targetEntity="TipusTreballador", inversedBy="tipusTasca")
     * @ORM\JoinColumn(name="tipusTreballadorId", referencedColumnName="id")
     */
    protected $tipusTreballador;



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
     * @return TipusTasca
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
     * Set tipusTreballador
     *
     * @param \HotelBundle\Entity\TipusTreballador $tipusTreballador
     *
     * @return TipusTasca
     */
    public function setTipusTreballador(\HotelBundle\Entity\TipusTreballador $tipusTreballador = null)
    {
        $this->tipusTreballador = $tipusTreballador;
    
        return $this;
    }

    /**
     * Get tipusTreballador
     *
     * @return \HotelBundle\Entity\TipusTreballador
     */
    public function getTipusTreballador()
    {
        return $this->tipusTreballador;
    }
}
