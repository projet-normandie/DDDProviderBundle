<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\ClassName;

/**
 * Trait TraitEntityNameRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\ClassName
 */
trait TraitEntityNameRepository
{
    /**
     * @return string
     */
    public function getEntityName(): string
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     * @return $this
     */
    public function setEntityName(string $entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }
}
