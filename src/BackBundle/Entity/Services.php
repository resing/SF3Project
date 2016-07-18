<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Services
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\ServicesRepository")
 */
class Services
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime")
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;
    /**
      * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Family", inversedBy="services",cascade={"persist", "remove", "detach", "merge"})
      * @ORM\joinColumn(name="family_id", referencedColumnName="id",onDelete="SET NULL")
     */
     private $family;
    /**
    * @Gedmo\Slug(fields={"name"})
    * @ORM\Column(length=128, unique=true)
    */
    private $slug;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\CmdQuotidien", mappedBy="service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CmdQuotidiens;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\CmdHouse", mappedBy="service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CmdHouses;
    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Adminis", mappedBy="service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $administrations;
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
     * Set name
     *
     * @param string $name
     *
     * @return Services
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
     * Set status
     *
     * @param boolean $status
     *
     * @return Services
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Services
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Services
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Services
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Services
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Services
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set family
     *
     * @param \BackBundle\Entity\Family $family
     *
     * @return Services
     */
    public function setFamily(\BackBundle\Entity\Family $family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return \BackBundle\Entity\Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Services
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CmdQuotidiens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->CmdHouses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cmdQuotidien
     *
     * @param \BackBundle\Entity\CmdQuotidien $cmdQuotidien
     *
     * @return Services
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
     * @return Services
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
     * @return Services
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
