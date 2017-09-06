<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\ClassName;

/**
 * Trait TraitEntityDotNamespace
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\ClassName
 */
trait TraitEntityDotNamespace
{
    /**
     * @var string $sEntityDotNamespace Full namespace of the entity using dots instead of backslashes.
     */
    protected $sEntityDotNamespace;

    /**
     * Sets the name of the entity class but with dots instead of backslashes.
     *
     * @param string $entityName
     * @return $this
     */
    public function initEntityDotNamespace(string $entityName)
    {
        $this->sEntityDotNamespace = \str_replace('\\', '.', $entityName);
        return $this;
    }
}
