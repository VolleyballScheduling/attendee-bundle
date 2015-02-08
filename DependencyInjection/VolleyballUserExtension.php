<?php
namespace Volleyball\Bundle\AttendeeBundle\DependencyInjection;

use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\Loader;
use \Doctrine\Common\Collections\ArrayCollection;

class VolleyballUserExtension extends \Symfony\Component\HttpKernel\DependencyInjection\Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // users
        $container->setParameter('volleyball.user.discriminator.users', $config['users']);
        
        // configs
        $container->setParameter('volleyball.user.discriminator.configs', $this->buildConfiguration($config['users']));
        
        // user types
        $container->setParameter('volleyball.user.discriminator.user_types', $this->buildUserTypes($config['users']));
        
        $container->setAlias('volleyball.user.manager.orm', $config['user_manager']);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
//        $loader->load(sprintf('%s.yml', $config['db_driver']));
    }
    
    /**
     * Build configuration
     * @param array $parameters
     */
    protected function buildConfiguration(array $parameters)
    {
        $configs = array();
        foreach ($parameters as $parameter) {
            $class = $parameter['entity']['class'];
            if (!class_exists($class)) {
                throw new \InvalidArgumentException(
                    sprintf('UserDiscriminator, configuration error : "%s" not found', $class)
                );
            }
            
            $config = new ArrayCollection();
            $config[$class] = array(
                    'factory' => $parameter['entity']['factory'],
                    'registration' => array(
                        'form' => array(
                            'type' => $parameter['registration']['form']['type'],
                            'name' => $parameter['registration']['form']['name'],
                            'validation_groups' => $parameter['registration']['form']['validation_groups'],
                        ),
                        'template' => $parameter['registration']['template'],
                    ),
                    'profile' => array(
                        'form' => array(
                            'type' => $parameter['profile']['form']['type'],
                            'name' => $parameter['profile']['form']['name'],
                            'validation_groups' => $parameter['profile']['form']['validation_groups'],
                        ),
                        'template' => $parameter['profile']['template'],
                    ),
                );
            $configs[$class] = $config;
        }
        return $configs;
    }
    
    /**
     * Build user types
     * @param array $users
     */
    protected function buildUserTypes(array $users)
    {
        $userTypes = array();
        while ($user = current($users)) {
            $class = $user['entity']['class'];
            if (!class_exists($class)) {
                throw new \InvalidArgumentException(
                    sprintf('ControllerListener, configuration error : "%s" not found', $class)
                );
            }
            $userType = strtolower(trim(key($users)));
            $userTypes[$userType]= $class;
            next($users);
        }
        return $userTypes;
    }
}
