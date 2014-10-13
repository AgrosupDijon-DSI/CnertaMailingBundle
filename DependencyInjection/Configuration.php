<?php

namespace Cnerta\MailingBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cnerta_mailing');
        
        $rootNode->children()
                ->arrayNode('from_email')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('address')->defaultValue('webmaster@example.com')->cannotBeEmpty()->end()
                            ->scalarNode('sender_name')->defaultValue('webmaster')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end();

        return $treeBuilder;
    }
}
