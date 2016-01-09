<?php
namespace Volleyball\Bundle\AttendeeBundle\Controller;

class AttendeeController extends \Volleyball\Bundle\UtilityBundle\Controller\Controller
{
    /**
     * Index action
     * @inheritdoc
     */
    public function indexAction(array $attendees)
    {
        return ['attendees' => $this->getAttendees()];
    }

    /**
     * New action
     * @inheritdoc
     */
    public function newAction()
    {
        $attendee = new \Volleyball\Bundle\AttendeeBundle\Entity\Attendee();
        $form = $this->createBoundObjectForm($attendee, 'new');

        if ($form->isBound() && $form->isValid()) {
            $this->persist($attendee, true);
            $this->addFlash('attendee created');

            return $this->redirectToRoute('volleyball_attendees_index');
        }

        return ['form' => $form->createView()];
    }
    
    /**
     * Search action
     * @inheritdoc
     */
    public function searchAction(array $attendees)
    {
        $attendee = new \Volleyball\Bundle\AttendeeBundle\Entity\Attendee();
        $form = $this->createBoundObjectForm($attendee, 'search');
        
        if ($form->isBound() && $form->isValid()) {
            /** @TODO finish attendee search, also restrict access */
            $attendees = array();

            return ['attendees' => $attendees];
        }

        return ['form' => $form->createView()];
    }
    
    /**
     * Show action
     * @inheritdoc
     */
    public function showAction(\Volleyball\Bundle\AttendeeBundle\Entity\Attendee $attendee)
    {
        return ['attendee' => $attendee];
    }


}