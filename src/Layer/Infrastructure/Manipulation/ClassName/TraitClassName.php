<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\ClassName;

/**
 * Trait TraitClassName
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\ClassName
 */
trait TraitClassName
{
    /**
     * Returns the lowercase class name of a full namespace.
     *
     * @param String $classNamespace
     * @return string
     */
    public function getClassName(string $classNamespace): string
    {
        return \strtolower(\substr(\strrchr($classNamespace, '\\'), 1));
    }
}
