<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Resolver;

use Symfony\Component\OptionsResolver\Exception\{
    AccessException, InvalidOptionsException, MissingOptionsException, NoSuchOptionException, OptionDefinitionException,
    UndefinedOptionsException
};
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ResolverStrategy.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Resolver
 */
class ResolverStrategy implements ResolverInterface
{
    /**
     * @var OptionsResolver
     */
    protected $resolver;

    /**
     * ResolverStrategy constructor.
     * @param $optionsResolver
     */
    public function __construct($optionsResolver)
    {
        $this->resolver = $optionsResolver;
    }

    /**
     * @param array $defaults
     * @return mixed
     * @throws AccessException
     */
    public function setDefaults(array $defaults)
    {
        return $this->resolver->setDefaults($defaults);
    }

    /**
     * @param $optionNames
     * @return mixed
     * @throws AccessException
     */
    public function setRequired($optionNames)
    {
        return $this->resolver->setRequired($optionNames);
    }

    /**
     * @param $option
     * @param null $allowedTypes
     * @return mixed
     * @throws AccessException
     * @throws UndefinedOptionsException
     */
    public function setAllowedTypes($option, $allowedTypes = null)
    {
        return $this->resolver->setAllowedTypes($option, $allowedTypes);
    }

    /**
     * @param $option
     * @param null $allowedValues
     * @return mixed
     * @throws AccessException
     * @throws UndefinedOptionsException
     */
    public function setAllowedValues($option, $allowedValues = null)
    {
        return $this->resolver->setAllowedValues($option, $allowedValues);
    }

    /**
     * @param array $options
     * @return mixed
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws AccessException
     * @throws UndefinedOptionsException
     * @throws NoSuchOptionException
     * @throws OptionDefinitionException
     */
    public function resolve(array $options = [])
    {
        return $this->resolver->resolve($options);
    }

    /**
     *
     * @throws AccessException
     */
    public function clear(): void
    {
        $this->resolver->clear();
    }
}
