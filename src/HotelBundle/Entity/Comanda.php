<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comanda
 *
 * @ORM\Table(name="comanda")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\ComandaRepository")
 */
class Comanda
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
     * @ORM\Column(name="dataEntrada", type="date", nullable=true)
     */
    private $dataEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataSortida", type="date", nullable=true)
     */
    private $dataSortida;

    /**
     * @var int
     *
     * @ORM\Column(name="idClient", type="integer", nullable=true)
     */
    private $idClient;


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
     * Set dataEntrada
     *
     * @param \DateTime $dataEntrada
     *
     * @return Comanda
     */
    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    
        return $this;
    }

    /**
     * Get dataEntrada
     *
     * @return \DateTime
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * Set dataSortida
     *
     * @param \DateTime $dataSortida
     *
     * @return Comanda
     */
    public function setDataSortida($dataSortida)
    {
        $this->dataSortida = $dataSortida;
    
        return $this;
    }

    /**
     * Get dataSortida
     *
     * @return \DateTime
     */
    public function getDataSortida()
    {
        return $this->dataSortida;
    }

    /**
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Comanda
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    
        return $this;
    }

    /**
     * Get idClient
     *
     * @return integer
     */
    public function getIdClient()
    {
        return $this->idClient;
    }
}

