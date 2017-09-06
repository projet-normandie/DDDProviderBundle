<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

/**
 * Trait TraitEntityIdCommand
 * Trait that contains the entity id property with its getter.
 * This trait should be used in every commands that required.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 */
trait TraitEntityIdCommand
{
    /**
     * @var int|string
     */
    protected $entityId;

    /**
     * @return int|string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }
}
