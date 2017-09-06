<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

/**
 * Trait TraitParameters
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 */
trait TraitParameters
{
    /** @var array */
    protected static $parameters = [];

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return static::$parameters;
    }

    /**
     * @param int|string $index
     * @param mixed $parameter
     * @return $this
     */
    public function addParameter($index, $parameter)
    {
        // todo: add refactoring of this.
        if (\is_int($index)) {
            static::$parameters[] = $parameter;
        } else {
            static::$parameters[$index] = $parameter;
        }

        return $this;
    }
}
