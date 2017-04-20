<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasca
 *
 * @ORM\Table(name="tasca")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TascaRepository")
 */
class Tasca
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataAlta", type="date", nullable=true)
     */
    private $dataAlta;

    /**
     * @ORM\ManyToOne(targetEntity="Treball", inversedBy="Tasca")
     * @ORM\JoinColumn(name="treballId", referencedColumnName="id")
     */
    protected $treball;

    /**
     * @ORM\ManyToOne(targetEntity="TipusTasca", inversedBy="Tasca")
     * @ORM\JoinColumn(name="tipusTascaId", referencedColumnName="id")
     */
    protected $tipusTasca;



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
     * @return Tasca
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
     * Set dataAlta
     *
     * @param \DateTime $dataAlta
     *
     * @return Tasca
     */
    public function setDataAlta($dataAlta)
    {
        $this->dataAlta = $dataAlta;
    
        return $this;
    }

    /**
     * Get dataAlta
     *
     * @return \DateTime
     */
    public function getDataAlta()
    {
        return $this->dataAlta;
    }

    /**
     * Set treball
     *
     * @param \HotelBundle\Entity\Treball $treball
     *
     * @return Tasca
     */
    public function setTreball(\HotelBundle\Entity\Treball $treball = null)
    {
        $this->treball = $treball;
    
        return $this;
    }

    /**
     * Get treball
     *
     * @return \HotelBundle\Entity\Treball
     */
    public function getTreball()
    {
        return $this->treball;
    }

    /**
     * Set tipusTasca
     *
     * @param \HotelBundle\Entity\TipusTasca $tipusTasca
     *
     * @return Tasca
     */
    public function setTipusTasca(\HotelBundle\Entity\TipusTasca $tipusTasca = null)
    {
        $this->tipusTasca = $tipusTasca;
    
        return $this;
    }

    /**
     * Get tipusTasca
     *
     * @return \HotelBundle\Entity\TipusTasca
     */
    public function getTipusTasca()
    {
        return $this->tipusTasca;
    }
}
