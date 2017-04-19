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
     * @var int
     *
     * @ORM\Column(name="idPedido", type="integer", nullable=true)
     */
    private $idPedido;

    /**
     * @var int
     *
     * @ORM\Column(name="idHabitacio", type="integer", nullable=true)
     */
    private $idHabitacio;


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
     * Set idPedido
     *
     * @param integer $idPedido
     *
     * @return Reserva
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;
    
        return $this;
    }

    /**
     * Get idPedido
     *
     * @return integer
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set idHabitacio
     *
     * @param integer $idHabitacio
     *
     * @return Reserva
     */
    public function setIdHabitacio($idHabitacio)
    {
        $this->idHabitacio = $idHabitacio;
    
        return $this;
    }

    /**
     * Get idHabitacio
     *
     * @return integer
     */
    public function getIdHabitacio()
    {
        return $this->idHabitacio;
    }
}

