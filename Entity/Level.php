<?php
namespace Volleyball\Bundle\AttendeeBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

use \Volleyball\Bundle\AttendeeBundle\Traits\HasAttendeesTrait;
use \Volleyball\Bundle\CoreBundle\Traits\SluggableTrait;
use \Volleyball\Bundle\CoreBundle\Traits\TimestampableTrait;

class Level
{
    use HasAttendeesTrait;
    use SluggableTrait;
    use TimestampableTrait;
    
    /**
     * Id
     * @var integer
     */
    protected $id;

    /**
     * Name
     * @var string
     */
    protected $name;
    
    /**
     * Description
     * @var string
     */
    protected $description;

    /**
     * Special
     * @var boolean
     */
    protected $special;
    
    /**
     * Organizations
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $organizations;
    
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     * @param string $description
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get organizations
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }
    
    /**
     * Set organizations
     * @param array $organizations
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function setOrganizations(array $organizations)
    {
        if (!$organizations instanceof ArrayCollection) {
            $organizations = new ArrayCollection($organizations);
        }
        
        $this->organizations = $organizations;
        
        return $this;
    }
    
    /**
     * Get organization
     * @param string $organization
     * @return \Volleyball\Bundle\OrganizationBundle\Entity\Organization
     */
    public function getOrganization($organization)
    {
        return $this->organzations->get($organization);
    }

    /**
     * Add organization
     * @param \Volleyball\Bundle\OrganizationBundle\Entity\Organization $organization
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function addOrganization(\Volleyball\Bundle\OrganizationBundle\Entity\Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }
    
    /**
     * Has organization
     * @param string $organization
     * @return boolean
     */
    public function hasOrganization($organization)
    {
        return $this->organizations->contains($organization);
    }

    /**
     * Is special
     * @param boolean|null $special
     * @return boolean|\Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function isSpecial($special = null)
    {
        if (null != $special) {
            $this->special = $special;

            return $this;
        }

        return $this->special;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
        $this->organizations = new ArrayCollection();
        $this->special = false;
    }
    
    /**
     * To string
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
