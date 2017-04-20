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
     * @ORM\ManyToOne(targetEntity="Tasca", inversedBy="Treball")
     * @ORM\JoinColumn(name="tascaId", referencedColumnName="id")
     */
    protected $tasca;

    /**
     * @ORM\ManyToOne(targetEntity="Treballador", inversedBy="Treball")
     * @ORM\JoinColumn(name="treballadorId", referencedColumnName="id")
     */
    protected $treballador;

    /**
     * @ORM\ManyToOne(targetEntity="Estat", inversedBy="Treball")
     * @ORM\JoinColumn(name="estatId", referencedColumnName="id")
     */
    protected $estat;



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
     * @param \HotelBundle\Entity\Tasca $tasca
     *
     * @return Treball
     */
    public function setTasca(\HotelBundle\Entity\Tasca $tasca = null)
    {
        $this->tasca = $tasca;
    
        return $this;
    }

    /**
     * Get tasca
     *
     * @return \HotelBundle\Entity\Tasca
     */
    public function getTasca()
    {
        return $this->tasca;
    }

    /**
     * Set treballador
     *
     * @param \HotelBundle\Entity\Treballador $treballador
     *
     * @return Treball
     */
    public function setTreballador(\HotelBundle\Entity\Treballador $treballador = null)
    {
        $this->treballador = $treballador;
    
        return $this;
    }

    /**
     * Get treballador
     *
     * @return \HotelBundle\Entity\Treballador
     */
    public function getTreballador()
    {
        return $this->treballador;
    }

    /**
     * Set estat
     *
     * @param \HotelBundle\Entity\Estat $estat
     *
     * @return Treball
     */
    public function setEstat(\HotelBundle\Entity\Estat $estat = null)
    {
        $this->estat = $estat;
    
        return $this;
    }

    /**
     * Get estat
     *
     * @return \HotelBundle\Entity\Estat
     */
    public function getEstat()
    {
        return $this->estat;
    }
}
