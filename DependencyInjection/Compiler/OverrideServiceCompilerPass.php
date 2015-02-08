<?php
namespace Volleyball\Bundle\AttendeeBundle\DependencyInjection\Compiler;

use \Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    /**
     * Process
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->changeService(
            $container,
            'fos_user.registration.form.factory',
            'volleyball.user.registration_form_factory'
        );
        
        $this->changeService(
            $container,
            'fos_user.profile.form.factory',
            'volleyball.user.profile_form_factory'
        );
    }
    
    /**
     * Change service
     * @param ContainerInterface $container
     * @param string $serviceName
     * @param string $newServiceName
     */
    private function changeService($container, $serviceName, $newServiceName)
    {
        $service = $container->getDefinition($serviceName);
        $newService = $container->getDefinition($newServiceName);
        
        if ($service && $newService) {
            $container->removeDefinition($serviceName);
            $container->setDefinition($serviceName, $newService);
        }
    }
}
