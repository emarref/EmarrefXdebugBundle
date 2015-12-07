<?php

namespace Emarref\Bundle\XdebugBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class EmarrefXdebugExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (!$config['enabled']) {
            $container->removeDefinition('emarref.xdebug.response.debug_listener');
            $container->removeDefinition('emarref.xdebug.response.profile_listener');
            $container->removeDefinition('emarref.xdebug.response.trace_listener');
        } else {
            $this->configureListener($container->getDefinition('emarref.xdebug.response.debug_listener'), $config['debugger']);
            $this->configureListener($container->getDefinition('emarref.xdebug.response.profile_listener'), $config['profiler']);
            $this->configureListener($container->getDefinition('emarref.xdebug.response.trace_listener'), $config['tracer']);
        }
    }

    /**
     * @param Definition $definition
     * @param array $config
     */
    protected function configureListener(Definition $definition, array $config)
    {
        $definition->replaceArgument(0, $config);
    }
}
