<?php
namespace Volleyball\Bundle\UserBundle\DependencyInjection;

use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\Loader;

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
        $users = $config['users'];
        $container->setParameter('volleyball.user.discriminator.users', $users);
        
        // configs
        $d_config = $this->buildConfiguration($users);
        $container->setParameter('volleyball.user.discriminator.configs', $d_config);
        
        // user types
        $userTypes = $this->buildUserTypes($users);
        $container->setParameter('volleyball.user.discriminator.user_types', $userTypes);
        
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
        foreach ($parameters as $parameter) {
            $class = $parameter['entity']['class'];
            if (!class_exists($class)) {
                throw new \InvalidArgumentException(
                    sprintf('UserDiscriminator, configuration error : "%s" not found', $class)
                );
            }
            
            $config = array();
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
        }
        return $config;
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
