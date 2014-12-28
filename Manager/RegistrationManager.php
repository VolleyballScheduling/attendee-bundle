<?php
namespace Volleyball\Bundle\UserBundle\Manager;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \FOS\UserBundle\Controller\RegistrationController;
use \Symfony\Component\HttpFoundation\RedirectResponse;

use \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator;
use \Volleyball\Bundle\UserBundle\Form\FormFactory;

class RegistrationManager
{
    /**
     *
     * @var \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator 
     */
    protected $userDiscriminator;
    
    /**
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface 
     */
    protected $container;
    
    /**
     *
     * @var \FOS\UserBundle\Controller\RegistrationController 
     */
    protected $controller;
    
    /**
     *
     * @var \Volleyball\Bundle\UserBundle\Form\FormFactory
     */
    protected $formFactory;
        
    /**
     * 
     * @param \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator $userDiscriminator
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(
        UserDiscriminator $userDiscriminator,
        ContainerInterface $container,
        RegistrationController $controller,
        FormFactory $formFactory
    ) {
        $this->userDiscriminator = $userDiscriminator;
        $this->container = $container;
        $this->controller = $controller;
        $this->formFactory = $formFactory;
    }
    
    /**
     * 
     * @param string $class
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function register($class)
    {
        $this->userDiscriminator->setClass($class);
        
        $this->controller->setContainer($this->container);
        $result = $this->controller->registerAction($this->container->get('request'));
        if ($result instanceof RedirectResponse) {
            return $result;
        }
        
        $template = $this->userDiscriminator->getTemplate('registration');
        if (is_null($template)) {
            $engine = $this->container->getParameter('fos_user.template.engine');
            $template = 'VolleyballResourceBundle:Registration:register.html.'.$engine;
        }
        
//        $flow = $this->container->get('volleyball.scenario.register.flow');
//        $form = $this->formFactory->createForm();
//        return $this->container->get('templating')->renderResponse($template, array(
//            'form' => $form->createView(),
//        ));
    }
}
