<?php

namespace Dugun\UploadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
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
        //$rootNode = $treeBuilder->root('dugun_upload');

        $treeBuilder->root('dugun_upload')
            ->children()
            ->variableNode('upload_service_name')
            ->example(['aws'])
            ->info('choose your uploader. dark side or light?? side!!!')
            ->validate()->ifNotInArray(array('aws'))->thenInvalid('Invalid uploader_type "%s"')->end()
            ->end()
            ->variableNode('temporary_path')
            ->defaultValue('/tmp')
            ->end()
            ->arrayNode('credentials')
            ->children()
            ->arrayNode('aws')
            ->children()
            ->variableNode('base_url')->end()
            ->variableNode('bucket')->end()
            ->variableNode('version')->end()
            ->variableNode('region')->end()
            ->variableNode('scheme')->end()
            ->arrayNode('credentials')
            ->children()
            ->variableNode('key')->end()
            ->variableNode('secret')->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
