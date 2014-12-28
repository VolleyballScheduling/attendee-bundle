<?php
namespace Volleyball\Bundle\UserBundle\Listener;

use \FOS\UserBundle\FOSUserEvents;
use \FOS\UserBundle\Event\UserEvent;
use \Symfony\Component\Security\Http\SecurityEvents;
use \Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use \Volleyball\Bundle\UserBundle\Discriminator\UserDiscriminator;

class AuthenticationListener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    /**
     * User discriminator
     * @var UserDiscriminator 
     */
    protected $userDiscriminator;
    
    /**
     * Construct
     * @param UserDiscriminator $controllerHandler 
     */
    public function __construct(UserDiscriminator $userDiscriminator)
    {
        $this->userDiscriminator = $userDiscriminator;
    }

    /**
     * Get subscribed events
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onSecurityImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }
    
    /**
     * Discriminate
     * @param mixed $user
     */
    protected function discriminate($user)
    {
        $this->userDiscriminator->setClass(get_class($user), true);
    }

    /**
     * On security implicit login
     * @param \FOS\UserBundle\Event\UserEvent $event
     */
    public function onSecurityImplicitLogin(UserEvent $event)
    {
        $this->discriminate($event->getUser());
    }
    
    /**
     * On security interactive login
     * @param \Symfony\Component\Security\Http\Event\InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->discriminate($event->getAuthenticationToken()->getUser());
    }
}
