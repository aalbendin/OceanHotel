<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitacio
 *
 * @ORM\Table(name="habitacio")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\HabitacioRepository")
 */
class Habitacio
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
     * @ORM\Column(name="numHabitacio", type="integer", nullable=true)
     */
    private $numHabitacio;

    /**
     * @var int
     *
     * @ORM\Column(name="places", type="integer", nullable=true)
     */
    private $places;

    /**
     * @var string
     *
     * @ORM\Column(name="preu", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $preu;

    /**
     * @var int
     *
     * @ORM\Column(name="tipusHabitacio", type="integer", nullable=true)
     */
    private $tipusHabitacio;


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
     * Set numHabitacio
     *
     * @param integer $numHabitacio
     *
     * @return Habitacio
     */
    public function setNumHabitacio($numHabitacio)
    {
        $this->numHabitacio = $numHabitacio;
    
        return $this;
    }

    /**
     * Get numHabitacio
     *
     * @return integer
     */
    public function getNumHabitacio()
    {
        return $this->numHabitacio;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Habitacio
     */
    public function setPlaces($places)
    {
        $this->places = $places;
    
        return $this;
    }

    /**
     * Get places
     *
     * @return integer
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set preu
     *
     * @param string $preu
     *
     * @return Habitacio
     */
    public function setPreu($preu)
    {
        $this->preu = $preu;
    
        return $this;
    }

    /**
     * Get preu
     *
     * @return string
     */
    public function getPreu()
    {
        return $this->preu;
    }

    /**
     * Set tipusHabitacio
     *
     * @param integer $tipusHabitacio
     *
     * @return Habitacio
     */
    public function setTipusHabitacio($tipusHabitacio)
    {
        $this->tipusHabitacio = $tipusHabitacio;
    
        return $this;
    }

    /**
     * Get tipusHabitacio
     *
     * @return integer
     */
    public function getTipusHabitacio()
    {
        return $this->tipusHabitacio;
    }
}
