<?php
namespace Volleyball\Bundle\AttendeeBundle;

use \Symfony\Component\DependencyInjection\ContainerBuilder;

class VolleyballAttendeeBundle extends \Knp\RadBundle\AppBundle\Bundle
{
    /**
     * @{inheritdoc}
     */
    public function buildConfiguration(NodeParentInterface $rootNode)
    {
    }

    /**
     * @{inheritdoc}
     */
    public function buildContainer(array $config, ContainerBuilder $container)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function getBundlePrefix()
    {
        return 'volleyball_attendee';
    }
}
