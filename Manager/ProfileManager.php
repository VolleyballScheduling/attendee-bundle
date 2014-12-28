<?php
namespace Volleyball\Bundle\UserBundle\Manager;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \FOS\UserBundle\Controller\ProfileController;
use \Symfony\Component\HttpFoundation\RedirectResponse;

use \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator;
use \Volleyball\Bundle\UserBundle\Form\Factory\FormFactory;

class ProfileManager
{
    /**
     * User discriminator
     * @var \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator
     */
    protected $userDiscriminator;

    /**
     * Service container
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Controller
     * @var \FOS\UserBundle\Controller\ProfileController
     */
    protected $controller;

    /**
     * Form factory
     * @var \Volleyball\Bundle\UserBundle\Form\Factory\FormFactory
     */
    protected $formFactory;

    /**
     * Construct
     * @param \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator $userDiscriminator
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param \FOS\UserBundle\Controller\ProfileController $controller
     * @param \Volleyball\Bundle\UserBundle\Form\FormFactory $formFactory
     */
    public function __construct(
        UserDiscriminator $userDiscriminator,
        ContainerInterface $container,
        ProfileController $controller,
        FormFactory $formFactory
    ) {
        $this->userDiscriminator = $userDiscriminator;
        $this->container = $container;
        $this->controller = $controller;
        $this->formFactory = $formFactory;
    }

    /**
     * Profile
     * @param string $class
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function profile($class)
    {
        $this->userDiscriminator->setClass($class);
        $this->controller->setContainer($this->container);
        
        $result = $this->controller->editAction($this->container->get('request'));
        if ($result instanceof RedirectResponse) {
            return $result;
        }

        $template = $this->userDiscriminator->getTemplate('profile');
        if (is_null($template)) {
            $engine = $this->container->getParameter('fos_user.template.engine');
            $template = 'FOSUserBundle:Profile:edit.html.'.$engine;
        }

        $form = $this->formFactory->createForm();
        return $this->container->get('templating')->renderResponse($template, array(
            'form' => $form->createView(),
        ));
    }
}
