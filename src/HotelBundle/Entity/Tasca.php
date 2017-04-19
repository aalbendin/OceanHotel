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
     * @var int
     *
     * @ORM\Column(name="tipusTreball", type="integer", nullable=true)
     */
    private $tipusTreball;

    /**
     * @var int
     *
     * @ORM\Column(name="tipusTasca", type="integer", nullable=true)
     */
    private $tipusTasca;


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
     * Set tipusTreball
     *
     * @param integer $tipusTreball
     *
     * @return Tasca
     */
    public function setTipusTreball($tipusTreball)
    {
        $this->tipusTreball = $tipusTreball;
    
        return $this;
    }

    /**
     * Get tipusTreball
     *
     * @return integer
     */
    public function getTipusTreball()
    {
        return $this->tipusTreball;
    }

    /**
     * Set tipusTasca
     *
     * @param integer $tipusTasca
     *
     * @return Tasca
     */
    public function setTipusTasca($tipusTasca)
    {
        $this->tipusTasca = $tipusTasca;
    
        return $this;
    }

    /**
     * Get tipusTasca
     *
     * @return integer
     */
    public function getTipusTasca()
    {
        return $this->tipusTasca;
    }
}

