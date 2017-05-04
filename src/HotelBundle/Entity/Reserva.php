<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\ReservaRepository")
 */
class Reserva
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
     * @ORM\ManyToOne(targetEntity="Comanda", inversedBy="Reserva", cascade={"persist"})
     * @ORM\JoinColumn(name="comandaId", referencedColumnName="id")
     */
    private $comanda;

    /**
     * @ORM\ManyToOne(targetEntity="Habitacio", inversedBy="Reserva", cascade={"persist"})
     * @ORM\JoinColumn(name="habitacioId", referencedColumnName="id")
     */
    private $habitacio;

    /**
     * @ORM\ManyToOne(targetEntity="Modalitat", inversedBy="Reserva")
     * @ORM\JoinColumn(name="modalitatId", referencedColumnName="id")
     */
    private $modalitat;


    

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
     * Set comanda
     *
     * @param \HotelBundle\Entity\Comanda $comanda
     *
     * @return Reserva
     */
    public function setComanda(\HotelBundle\Entity\Comanda $comanda = null)
    {
        $this->comanda = $comanda;
    
        return $this;
    }

    /**
     * Get comanda
     *
     * @return \HotelBundle\Entity\Comanda
     */
    public function getComanda()
    {
        return $this->comanda;
    }

    /**
     * Set habitacio
     *
     * @param \HotelBundle\Entity\Habitacio $habitacio
     *
     * @return Reserva
     */
    public function setHabitacio(\HotelBundle\Entity\Habitacio $habitacio = null)
    {
        $this->habitacio = $habitacio;
    
        return $this;
    }

    /**
     * Get habitacio
     *
     * @return \HotelBundle\Entity\Habitacio
     */
    public function getHabitacio()
    {
        return $this->habitacio;
    }

    /**
     * Set modalitat
     *
     * @param \HotelBundle\Entity\Modalitat $modalitat
     *
     * @return Reserva
     */
    public function setModalitat(\HotelBundle\Entity\Modalitat $modalitat = null)
    {
        $this->modalitat = $modalitat;
    
        return $this;
    }

    /**
     * Get modalitat
     *
     * @return \HotelBundle\Entity\Modalitat
     */
    public function getModalitat()
    {
        return $this->modalitat;
    }
}
