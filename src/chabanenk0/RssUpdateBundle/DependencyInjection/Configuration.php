<?php

namespace chabanenk0\RssUpdateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chabanenk0_rss_update');
        $rootNode
            ->children()
                ->variableNode('url')
                    ->defaultValue('http://localhost/rss/physics.xml')
                    ->info('Url that gives rss feed')
                    ->example('example setting')
                ->end()
            ->end()
        ;
        // node types http://api.symfony.com/2.4/Symfony/Component/Config/Definition/Builder/NodeBuilder.html
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
