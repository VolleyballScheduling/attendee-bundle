<?php
namespace Volleyball\Bundle\AttendeeBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

class Attendee extends \Volleyball\Bundle\UserBundle\Entity\User
{
    /**
     * Id
     * @var integer
     */
    protected $id;
    
    /**
     * First name
     * @var string 
     */
    protected $firstName;

    /**
     * Last name
     * @var string 
     */
    protected $lastName;

    /**
     * Gender
     * @var string
     */
    protected $gender;
   
    /**
     * Birthdate
     * @var \DateTime 
     */
    protected $birthdate;

    /**
     * Active enrollment
     * @var \Volleyball\Bundle\EnrollmentBundle\Entity\ActiveEnrollment 
     */
    protected $activeEnrollment;

    /**
     * Facebook id
     * @var string
     */
    protected $facebookId;

    /**
     * Google id
     * @var string
     */
    protected $googleId;

    /**
     * Linkedin id
     * @var string
     */
    protected $linkedinId;

    /**
     * Twitter id
     * @var string
     */
    protected $twitterId;

    /**
     * Foursquare id
     * @var string
     */
    protected $foursquareId;

    /**
     * Avatar
     * @var string
     */
    protected $avatar;

    /**
     * Passel
     * @var \Volleyball\Bundle\PasselBundle\Entity\Passel
     */
    protected $passel;

    /**
     * Faction
     * @var \Volleyball\Bundle\PasselBundle\Entity\Faction
     */
    protected $faction;

    /**
     * Position
     * @var \Volleyball\Bundle\AttendeeBundle\Entity\Position
     */
    protected $position;

    /**
     * Level
     * @var \Volleyball\Bundle\AttendeeBundle\Entitty\Level
     */
    protected $level;
    
    /**
     * Enrollments
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $enrollments;
    
    /**
     * Slug
     * @var string
     */
    protected $slug;

    /**
     * Get slug
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     * @param slug $slug
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setSlug($slug = null)
    {
        if (null == $slug) {
            $this->slug = str_replace(
                ' ',
                '-',
                $this->getName()
            );
        }

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * Get the full name
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * Set active enrollment
     * @param \Volleyball\Bundle\EnrollmentBundle\Entity\ActiveEnrollment $activeEnrollment
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setActiveEnrollment(\Volleyball\Bundle\EnrollmentBundle\Entity\ActiveEnrollment $activeEnrollment)
    {
        $this->activeEnrollment = $activeEnrollment;

        return $this;
    }

    /**
     * Get active enrollment
     * @return \Volleyball\Bundle\EnrollmentBundle\Entity\AttendeeEnrollment
     */
    public function getActiveEnrollment()
    {
        return $this->activeEnrollment;
    }

    /**
     * Set facebook id
     * @param string $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
        $this->salt = '';
    }

    /**
     * Get facebook id
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set FB data
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstName($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastName($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /**
     * Set first name
     * @param string $firstname
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setFirstName($firstname)
    {
        $this->firstName = $firstname;

        return $this;
    }

    /**
     * Get first name
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set last name
     * @param string $lastname
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setLastName($lastname)
    {
        $this->lastName = $lastname;

        return $this;
    }

    /**
     * Get last name
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Set username
     * @param string $username
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set google id
     * @param string $googleId
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get google id
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set linkedin id
     * @param string $linkedinId
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;

        return $this;
    }

    /**
     * Get linkedin id
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set twitter id
     * @param string $twitterId
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;

        return $this;
    }

    /**
     * Get twitter id
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * Set foursquare id
     * @param string $foursquareId
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setFoursquareId($foursquareId)
    {
        $this->foursquareId = $foursquareId;

        return $this;
    }

    /**
     * Get foursquare id
     * @return string
     */
    public function getFoursquareId()
    {
        return $this->foursquareId;
    }

    /**
     * Set avatar
     * @param string $avatar
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set gender
     * @param string $gender
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthdate
     * @param \DateTime $birthdate
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    
    /**
     * Is enabled
     * @param boolean|null $enabled
     * @return boolean|\Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function isEnabled($enabled = null)
    {
        if (null == $enabled) {
            return (bool) $this->enabled;
        }
        
        $this->enabled = $enabled   ;
        
        return $this;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get passel
     * @return \Volleyball\Bundle\PasselBundle\Entity\Passel
     */
    public function getPassel()
    {
        return $this->passel;
    }

    /**
     * Set passel
     * @param \Volleyball\Bundle\PasselBundle\Entity\Passel $passel
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setPassel(\Volleyball\Bundle\PasselBundle\Entity\Passel $passel)
    {
        $this->passel = $passel;

        return $this;
    }

    /**
     * Get faction
     * @return \Volleyball\Bundle\PasselBundle\Entity\Faction
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Set faction
     * @param \Volleyball\Bundle\PasselBundle\Entity\Faction $faction
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setFaction(\Volleyball\Bundle\PasselBundle\Entity\Faction $faction)
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * Get position
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     * @param \Volleyball\Bundle\AttendeeBundle\Entity\Position $position
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setPosition(\Volleyball\Bundle\AttendeeBundle\Entity\Position $position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get level
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set level
     * @param \Volleyball\Bundle\AttendeeBundle\Entity\Level $level
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setLevel(\Volleyball\Bundle\AttendeeBundle\Entity\Level $level)
    {
        $this->level = $level;

        return $this;
    }
    
    /**
     * Get enrollments
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEnrollments()
    {
        return $this->enrollments;
    }

    /**
     * Set enrollments
     * @param array $enrollments
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function setEnrollments(array $enrollments)
    {
        if (! $enrollments instanceof ArrayCollection) {
            $enrollments = new ArrayCollection($enrollments);
        }

        $this->enrollments = $enrollments;

        return $this;
    }

    /**
     * Has enrollments
     * @return boolean
     */
    public function hasEnrollments()
    {
        return !$this->enrollments->isEmpty();
    }

    /**
     * Add enrollment
     * @param \Volleyball\Bundle\EnrollmentBundle\Entity\Attendee $enrollment
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function addEnrollment(\Volleyball\Component\Enrollment\Model\Attendee $enrollment)
    {
        $this->enrollments->add($enrollment);

        return $this;
    }

    /**
     * Remove enrollment
     * @param string|\Volleyball\Bundle\EnrollmentBundle\Entity\Attendee $enrollment
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function removeEnrollment($enrollment)
    {
        $this->enrollments->remove($enrollment);

        return $this;
    }

    /**
     * Get enrollment
     * @param string $enrollment
     * @return \Volleyball\Bundle\EnrollmentBundle\Entity\AttendeeEnrollment
     */
    public function getEnrollment($enrollment)
    {
        return $this->enrollments->get($enrollment);
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
    }
    
    /**
     * To string
     * @return string
     */
    public function __toString()
    {
        return $this->firstName.' '.$this->lastName;
    }
}
