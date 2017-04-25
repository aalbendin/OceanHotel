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
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="TipusTreballador")
     * @ORM\JoinColumn(name="rolAsociatID", referencedColumnName="id")
     */
    private $rolAsociat;


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



    /**
     * Set rolAsociat
     *
     * @param \HotelBundle\Entity\Rol $rolAsociat
     *
     * @return TipusTreballador
     */
    public function setRolAsociat(\HotelBundle\Entity\Rol $rolAsociat = null)
    {
        $this->rolAsociat = $rolAsociat;

        return $this;
    }

    /**
     * Get rolAsociat
     *
     * @return \HotelBundle\Entity\Rol
     */
    public function getRolAsociat()
    {
        return $this->rolAsociat;
    }
}
