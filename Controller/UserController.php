<?php
namespace Volleyball\Bundle\UserBundle\Controller;

use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Request;

use \Pagerfanta\Pagerfanta;
use \Pagerfanta\Adapter\DoctrineORMAdapter;
use \Pagerfanta\Exception\NotValidCurrentPageException;

class UserController extends \Volleyball\Bundle\UtilityBundle\Controller\UtilityController
{
    protected $available_roles = array();

    /**
     * Index
     * 
     * @Route("/users", name="volleyball_user_index")
     * @return  array 
     */
    public function indexAction(Request $request)
    {
        return $this->forward('VolleyballUtilityBundle:Homepage:index');
    }

    /**
     * @Route("/signup", name="volleyball_user_register")
     * @Template("VolleyballResourceBundle:User:register.html.twig")
     */
    public function registerAction()
    {
        return $this
                ->container
                ->get('pugx_multi_user.registration_manager')
                ->register('\Volleyball\Bundle\UserBundle\Entity\User');
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $registration = $form->getData();

            $em->persist($registration->getUser());
            $em->flush();

            return $this->redirect('VolleyballUserBundle:User:dashboard');
        }

        return array('form'  =>  $form->createView());
    }
}
