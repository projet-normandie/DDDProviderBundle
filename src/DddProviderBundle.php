<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use ProjetNormandie\DddProviderBundle\DependencyInjection\DddProviderBundleExtension;

/**
 * Class DddProviderBundle
 * @package ProjetNormandie\DddProviderBundle
 */
class DddProviderBundle extends Bundle
{
    /**
     * @return DddProviderBundleExtension
     */
    public function getContainerExtension(): DddProviderBundleExtension
    {
        return new DddProviderBundleExtension();
    }
}
