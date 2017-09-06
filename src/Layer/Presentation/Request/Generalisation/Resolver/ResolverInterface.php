<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Resolver;

/**
 * Interface ResolverInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Resolver
 */
interface ResolverInterface
{
    /**
     * @param array $defaults
     * @return mixed
     */
    public function setDefaults(array $defaults);

    /**
     * @param $optionNames
     * @return mixed
     */
    public function setRequired($optionNames);

    /**
     * @param $option
     * @param null|string $allowedTypes
     * @return mixed
     */
    public function setAllowedTypes($option, $allowedTypes = null);

    /**
     * @param $option
     * @param null|string $allowedValues
     * @return mixed
     */
    public function setAllowedValues($option, $allowedValues = null);

    /**
     * @param array $options
     * @return mixed
     */
    public function resolve(array $options = []);

    /**
     * @return void
     */
    public function clear(): void;
}
