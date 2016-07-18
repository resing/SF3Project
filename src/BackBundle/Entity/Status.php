<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\StatusRepository")
 */
class Status
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Adminis", mappedBy="status")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $administrations;
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
     * Set name
     *
     * @param string $name
     *
     * @return Status
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->administrations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add administration
     *
     * @param \BackBundle\Entity\Adminis $administration
     *
     * @return Status
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
