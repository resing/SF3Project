<?php
// src/AppBundle/Entity/User.php

namespace UtilisateursBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee")
 */
class Utilisateurs extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        
        // your own logic
    }
    /**
      * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Business", inversedBy="utilisateurs")
      * @ORM\JoinColumn(nullable=true)
     */
     private $business;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\CmdQuotidien", mappedBy="utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CmdQuotidiens;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\CmdHouse", mappedBy="utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CmdHouses;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Adminis", mappedBy="utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $administrations;
    /**
     * Set business
     *
     * @param \BackBundle\Entity\Business $business
     *
     * @return Utilisateurs
     */
    public function setBusiness(\BackBundle\Entity\Business $business)
    {
        $this->business = $business;

        return $this;
    }
    /**
     * Get business
     *
     * @return \BackBundle\Entity\Business
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Add cmdQuotidien
     *
     * @param \BackBundle\Entity\CmdQuotidien $cmdQuotidien
     *
     * @return Utilisateurs
     */
    public function addCmdQuotidien(\BackBundle\Entity\CmdQuotidien $cmdQuotidien)
    {
        $this->CmdQuotidiens[] = $cmdQuotidien;

        return $this;
    }

    /**
     * Remove cmdQuotidien
     *
     * @param \BackBundle\Entity\CmdQuotidien $cmdQuotidien
     */
    public function removeCmdQuotidien(\BackBundle\Entity\CmdQuotidien $cmdQuotidien)
    {
        $this->CmdQuotidiens->removeElement($cmdQuotidien);
    }

    /**
     * Get cmdQuotidiens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCmdQuotidiens()
    {
        return $this->CmdQuotidiens;
    }

    /**
     * Add cmdHouse
     *
     * @param \BackBundle\Entity\CmdHouse $cmdHouse
     *
     * @return Utilisateurs
     */
    public function addCmdHouse(\BackBundle\Entity\CmdHouse $cmdHouse)
    {
        $this->CmdHouses[] = $cmdHouse;

        return $this;
    }

    /**
     * Remove cmdHouse
     *
     * @param \BackBundle\Entity\CmdHouse $cmdHouse
     */
    public function removeCmdHouse(\BackBundle\Entity\CmdHouse $cmdHouse)
    {
        $this->CmdHouses->removeElement($cmdHouse);
    }

    /**
     * Get cmdHouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCmdHouses()
    {
        return $this->CmdHouses;
    }

    /**
     * Add administration
     *
     * @param \BackBundle\Entity\Adminis $administration
     *
     * @return Utilisateurs
     */
    public function addAdministration(\BackBundle\Entity\Adminis $administration)
    {
        $this->administrations[] = $administration;

        return $this;
    }

    /**
     * Remove administration
     *
     * @param \BackBundle\Entity\Adminis $administration
     */
    public function removeAdministration(\BackBundle\Entity\Adminis $administration)
    {
        $this->administrations->removeElement($administration);
    }

    /**
     * Get administrations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdministrations()
    {
        return $this->administrations;
    }
}
