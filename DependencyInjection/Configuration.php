<?php

namespace Emarref\Bundle\XdebugBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $root = $builder->root('emarref_xdebug');

        $root
            ->canBeDisabled()
        ;

        $this->configureDebug($root);
        $this->configureProfiler($root);
        $this->configureTracer($root);

        return $builder;
    }

    /**
     * @param ArrayNodeDefinition $root
     */
    public function configureDebug(ArrayNodeDefinition $root)
    {
        $root
            ->children()
                ->arrayNode('debugger')
                    ->canBeDisabled()
                    ->children()
                        ->scalarNode('idekey')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('path')->defaultValue('/')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $root
     */
    public function configureProfiler(ArrayNodeDefinition $root)
    {
        $root
            ->children()
                ->arrayNode('profiler')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('path')->defaultValue('/')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $root
     */
    public function configureTracer(ArrayNodeDefinition $root)
    {
        $root
            ->children()
                ->arrayNode('tracer')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('path')->defaultValue('/')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
