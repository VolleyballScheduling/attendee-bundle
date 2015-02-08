<?php
namespace Volleyball\Bundle\AttendeeBundle;

use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use \Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

use \Volleyball\Bundle\AttendeeBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class VolleyballAttendeeBundle extends AbstractResourceBundle
{
    /**
     * {@inheritdoc}
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getBundlePrefix()
    {
        return 'volleyball_user';
    }
}
