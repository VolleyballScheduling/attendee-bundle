<?php
namespace Volleyball\Bundle\AttendeeBundle\Traits;

trait HasAttendeesTrait
{
    /**
     * Attendees
     * @var \Doctrine\Common\Collections\ArrayCollection 
     */
    protected $attendees;
    
    /**
     * Has attendees
     * @return boolean
     */
    public function hasAttendees()
    {
        return $this->attendees->isEmpty();
    }
    
    /**
     * Has attendee
     * @param string $attendee
     * @return boolean
     */
    public function hasAttendee($attendee)
    {
        return $this->attendees->contains($attendee);
    }
    
    /**
     * Get attendees
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
    
    /**
     * Set attendees
     * @param array $attendees
     * @return mixed
     */
    public function setAttendees(array $attendees)
    {
        if (!$attendees instanceof \Docrine\Common\Collections\ArrayCollection) {
            $attendees = new \Doctrine\Common\Collections\ArrayCollection($attendees);
        }
        
        $this->attendees = $attendees;
        
        return $this;
    }
    
    /**
     * Get attendee
     * @param string $attendee
     * @return \Volleyball\Bundle\AttendeeBundle\Entity\Attendee
     */
    public function getAttendee($attendee)
    {
        return $this->attendees->get($attendee);
    }
    
    /**
     * Add attendee
     * @param \Volleyball\Bundle\AttendeeBundle\Entity\Attendee $attendee
     * @return mixed
     */
    public function addAttendee(\Volleyball\Bundle\AttendeeBundle\Entity\Attendee $attendee)
    {
        $this->attendees->add($attendee);
    
        return $this;
    }
}
