<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CmdHouse
 *
 * @ORM\Table(name="cmd_house")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\CmdHouseRepository")
 */
class CmdHouse
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
     * @ORM\Column(name="nature", type="string", length=255)
     */
    private $nature;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer",nullable=false)
     */
    private $quantity;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;
    /**
     * @ORM\ManyToOne(targetEntity="UtilisateursBundle\Entity\Utilisateurs", inversedBy="CmdHouses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $utilisateur;
    /**
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Services", inversedBy="CmdHouses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $service;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nature
     *
     * @param string $nature
     *
     * @return CmdHouse
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return string
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CmdHouse
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return CmdHouse
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set utilisateur
     *
     * @param \UtilisateursBundle\Entity\Utilisateurs $utilisateur
     *
     * @return CmdHouse
     */
    public function setUtilisateur(\UtilisateursBundle\Entity\Utilisateurs $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \UtilisateursBundle\Entity\Utilisateurs
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set service
     *
     * @param \BackBundle\Entity\Services $service
     *
     * @return CmdHouse
     */
    public function setService(\BackBundle\Entity\Services $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \BackBundle\Entity\Services
     */
    public function getService()
    {
        return $this->service;
    }
}
