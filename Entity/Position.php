<?php
namespace Volleyball\Bundle\AttendeeBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

use \Volleyball\Bundle\AttendeeBundle\Traits\HasAttendeesTrait;
use \Volleyball\Bundle\CoreBundle\Traits\SluggableTrait;
use \Volleyball\Bundle\CoreBundle\Traits\TimestampableTrait;

class Position
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
     * Organization
     * @var \Volleyball\Bundle\OrganizationBundle\Entity\Organization
     */
    protected $organization;
    
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
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Position
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
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Position
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get organization
     * @return \Volleyball\Bundle\OrganizationBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set organization
     * @param \Volleyball\Bundle\OrganizationBundle\Entity\Organization $organization
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Position
     */
    public function setOrganization(\Volleyball\Bundle\OrganizationBundle\Entity\Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
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
