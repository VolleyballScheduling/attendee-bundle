<?php
namespace Volleyball\Bundle\AttendeeBundle\Controller;

use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Request;

class AttendeeController extends \Volleyball\Bundle\CoreBundle\Controller\CoreController
{
    /**
     * @Route("/attendees", name="volleyball_attendee_index")
     * @Route("/passels/{passel}/attendees", name="volleyball_attendee_index_by_passel")
     * @Route("/passels/{passel}/factions/{faction}/attendees", name="volleyball_attendee_index_by_faction")
     * @Template("VolleyballResourceBundle:Attendee:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * @Route("/attendees/new", name="volleyball_attendee_new")
     * @Template("VolleyballPasselbundle:Attendee:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $attendee = $this->get('volleyball.repository.attendee')->createNew();
        $form = $this->createForm(
            new \Volleyball\Bundle\AttendeeBundle\Form\Type\AttendeeFormType(),
            $attendee
        );

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($attendee);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'attendee created.'
                );

                return $this->render(
                    'VolleyballAttendeeBundle:Attendee:show.html.twig',
                    array('attendee' => $attendee )
                );
            }
        }

        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/attendees/search", name="volleyball_attendee_search")
     * @Template("VolleyballAttendeeBundle:Attendee:search.html.twig")
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(new \Volleyball\Bundle\AttendeeBundle\Form\Type\Search\AttendeeSearchFormType());
        
        if ("POST" == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $attendees = $this->repository()->search($request->getParameter('query'));

                return $this->render(
                    'VolleyballAttendeeBundle:Attendee:index.html.twig',
                    array('attendees' => $attendees )
                );
            }
        }

        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/attendees/{slug}", name="volleyball_attendee_show")
     * @Template("VolleyballAttendeeBundle:Attendee:show.html.twig")
     */
    public function showAction(Request $request)
    {
        $slug = $request->getParameter('slug');
        $attendee = $this->get('volleyball.repository.attendee')
            ->findOneBySlug($slug);

        if (!$attendee) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching attendee found.'
            );
            $this->redirect($this->generateUrl('volleyball_attendee_index'));
        }

        return array('attendee' => $attendee);
    }
    
    public function registerAction()
    {
        return $this
                ->container
                ->get('pugx_multi_user.registration_manager')
                ->register('Volleyball\Bundle\AttendeeBundle\Entity\Attendee');
    }
    
    /**
     * @Route("/widget", name="volleyball_attendee_widget")
     */
    public function widgetAction(Request $request)
    {
        $factions = $this->getDoctrine()
                ->getRepository('VolleyballAttendeeBundle:Attendee')
                ->findAllByPassel($this->getUser()->getPassel());
        
        return $factions;
    }
}
