<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Workflow\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\PatchOneCommandInterface;

/**
 * Trait TraitEntityIdPatchMany.
 * This trait provides methods that allow observers on a workflow to loop over many commands to list all entity ids.
 * Only for PatchMany actions.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Workflow\Generalisation
 */
trait TraitEntityIdPatchMany
{
    /**
     * Builds and sets the entityId in the workflow data for each commands.
     *
     * @return $this
     */
    protected function setEntityId()
    {
        $this->wfLastData->entityId = \array_map([$this, 'buildIdFromCommand'], $this->wfLastData->patchOneCommands);
        return $this;
    }

    /**
     * Builds an entity Id from the PatchOneCommand given.
     *
     * @param PatchOneCommandInterface $command
     * @return int|string
     */
    private function buildIdFromCommand(PatchOneCommandInterface $command)
    {
        return $command->getEntityId();
    }
}
