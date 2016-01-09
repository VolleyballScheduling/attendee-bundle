<?php
namespace Volleyball\Bundle\AttendeeBundle\DependencyInjection;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new \Symfony\Component\Config\Definition\Builder\TreeBuilder();
        $rootNode = $treeBuilder->root('volleyball_attendee');

        return $treeBuilder;
    }
}
