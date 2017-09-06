<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class DddProviderBundleExtension
 *
 * @category ProjetNormandie\DddProviderBundle
 * @package DependencyInjection
 */
class DddProviderBundleExtension extends Extension
{
    /*public*/ const BUNDLE_ALIAS = 'normandie_ddd';
    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return static::BUNDLE_ALIAS;
    }
}
