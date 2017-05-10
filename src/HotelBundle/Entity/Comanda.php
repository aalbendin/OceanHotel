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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="Comanda" , cascade={"persist"})
     * @ORM\JoinColumn(name="clientId", referencedColumnName="id")
     */
    protected $client;


    
    

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
     * Set client
     *
     * @param \HotelBundle\Entity\Client $client
     *
     * @return Comanda
     */
    public function setClient(\HotelBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \HotelBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

}
