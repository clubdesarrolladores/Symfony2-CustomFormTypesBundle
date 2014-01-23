<?php

namespace Umbrellaweb\Bundle\CustomFormTypesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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
        $rootNode = $treeBuilder->root('umbrellaweb_bundle_custom_form_types');
        
        $this->addReCaptcha($rootNode);
        
        return $treeBuilder;
    }
    
    public function addReCaptcha(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('recaptcha')
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('public_key')->cannotBeEmpty()->end()
                        ->scalarNode('private_key')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ->end();
    }
}
