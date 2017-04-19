<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Treball
 *
 * @ORM\Table(name="treball")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\TreballRepository")
 */
class Treball
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataInici", type="date", nullable=true)
     */
    private $dataInici;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataFi", type="date", nullable=true)
     */
    private $dataFi;

    /**
     * @var int
     *
     * @ORM\Column(name="tasca", type="integer", nullable=true)
     */
    private $tasca;

    /**
     * @var int
     *
     * @ORM\Column(name="treballador", type="integer", nullable=true)
     */
    private $treballador;

    /**
     * @var int
     *
     * @ORM\Column(name="estat", type="integer", nullable=true)
     */
    private $estat;


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
     * Set dataInici
     *
     * @param \DateTime $dataInici
     *
     * @return Treball
     */
    public function setDataInici($dataInici)
    {
        $this->dataInici = $dataInici;
    
        return $this;
    }

    /**
     * Get dataInici
     *
     * @return \DateTime
     */
    public function getDataInici()
    {
        return $this->dataInici;
    }

    /**
     * Set dataFi
     *
     * @param \DateTime $dataFi
     *
     * @return Treball
     */
    public function setDataFi($dataFi)
    {
        $this->dataFi = $dataFi;
    
        return $this;
    }

    /**
     * Get dataFi
     *
     * @return \DateTime
     */
    public function getDataFi()
    {
        return $this->dataFi;
    }

    /**
     * Set tasca
     *
     * @param integer $tasca
     *
     * @return Treball
     */
    public function setTasca($tasca)
    {
        $this->tasca = $tasca;
    
        return $this;
    }

    /**
     * Get tasca
     *
     * @return integer
     */
    public function getTasca()
    {
        return $this->tasca;
    }

    /**
     * Set treballador
     *
     * @param integer $treballador
     *
     * @return Treball
     */
    public function setTreballador($treballador)
    {
        $this->treballador = $treballador;
    
        return $this;
    }

    /**
     * Get treballador
     *
     * @return integer
     */
    public function getTreballador()
    {
        return $this->treballador;
    }

    /**
     * Set estat
     *
     * @param integer $estat
     *
     * @return Treball
     */
    public function setEstat($estat)
    {
        $this->estat = $estat;
    
        return $this;
    }

    /**
     * Get estat
     *
     * @return integer
     */
    public function getEstat()
    {
        return $this->estat;
    }
}

