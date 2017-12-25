<?php

namespace OW\CommunicationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ow_communication');

        $rootNode
            ->children()
                ->scalarNode('message_author_email')->isRequired()->end()
                ->integerNode('max_messages_to_send')->defaultValue(5)->end()
                ->integerNode('max_error_count')->defaultValue(3)->end()
            ->end();

        return $treeBuilder;
    }
}
