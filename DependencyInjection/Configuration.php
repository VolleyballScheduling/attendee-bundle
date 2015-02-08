<?php
namespace Volleyball\Bundle\AttendeeBundle\DependencyInjection;

use \Symfony\Component\Config\Definition\Builder\TreeBuilder;
use \Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('volleyball_user');

        $supportedDrivers = array('orm'); //, 'mongodm');

        $rootNode->
            children()
                ->scalarNode('db_driver')
                    ->defaultValue('orm')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                ->end();

        $rootNode->
            children()
                ->scalarNode('user_manager')
                    ->defaultValue('volleyball.user.manager.orm_user_manager.default')
                    ->end()
                ->end();

        $rootNode->
                children()
                    ->arrayNode('users')->prototype('array')
                        ->children()
                            ->arrayNode('entity')
                                ->children()
                                    ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue('\Volleyball\Bundle\AttendeeBundle\Factory\UserFactory')->end()
                                ->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode('registration')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('type')->defaultValue(null)->end()
                                            ->scalarNode('name')->defaultValue('volleyball_user_registration')->end()
                                            ->arrayNode('validation_groups')
                                                ->prototype('scalar')->end()
                                                ->defaultValue(array('Registration', 'Default'))
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->scalarNode('template')->defaultValue(null)->end()
                                 ->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode('profile')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('type')->defaultValue(null)->end()
                                            ->scalarNode('name')->defaultValue('volleyball_user_profile')->end()
                                            ->arrayNode('validation_groups')
                                                ->prototype('scalar')->end()
                                                ->defaultValue(array('Profile', 'Default'))
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->scalarNode('template')->defaultValue(null)->end()
                                 ->end()
                            ->end()
                        ->end()

                    ->end()
                ->end()
                ->end();

        return $treeBuilder;
    }
}
