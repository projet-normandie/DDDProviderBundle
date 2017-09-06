<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Workflow\Generalisation;

/**
 * Trait TraitElementPointer.
 * This trait provides methods that allow observers on a workflow to access to any workflow step.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Workflow\Generalisation
 */
trait TraitElementPointer
{
    /**
     * Return the first step of the given data for the workflow.
     * @param array $list List of statuses of a single data through the whole workflow.
     * @return mixed The data at its first status.
     */
    public static function getFirstElement(array $list)
    {
        return \reset($list);
    }

    /**
     * Return the last step of the given data for the workflow.
     * @param array $list List of statuses of a single data through the whole workflow.
     * @return mixed The data at its last status.
     */
    public static function getLastElement(array $list)
    {
        return \end($list);
    }
}
