<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Workflow\Generalisation;

use Exception;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\UpdateOneCommandInterface;

/**
 * Trait TraitEntityIdUpdateMany.
 * This trait provides methods that allow observers on a workflow to loop over many commands to list all entity ids.
 * Only for UpdateMany actions.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Workflow\Generalisation
 */
trait TraitEntityIdUpdateMany
{
    /**
     * Builds and sets the entityId in the workflow data for each commands.
     *
     * @return $this
     * @throws Exception
     */
    protected function setEntityId()
    {
        $this->wfLastData->entityId = \array_map([$this, 'buildIdFromCommand'], $this->wfLastData->updateOneCommands);
        return $this;
    }

    /**
     * Builds an entity Id from the UpdateOneCommand given.
     *
     * @param UpdateOneCommandInterface $command
     * @return int|string
     * @throws Exception
     */
    private function buildIdFromCommand(UpdateOneCommandInterface $command)
    {
        return $command->getEntityId();
    }
}
