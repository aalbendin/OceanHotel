<?php

namespace HotelBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

        /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="User")
     * @ORM\JoinColumn(name="rolId", referencedColumnName="id")
     */
    private $rol;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Set rol
     *
     * @param \HotelBundle\Entity\Rol $rol
     *
     * @return User
     */
    public function setRol(\HotelBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;
    
        return $this;
    }

    /**
     * Get rol
     *
     * @return \HotelBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }
}
