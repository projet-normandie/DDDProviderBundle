<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use stdClass;

/**
 * Interface WorkflowHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Workflow\Generalisation
 */
interface WorkflowHandlerInterface
{
    /**
     * Processes with the given Command object.
     *
     * @param CommandInterface $command
     */
    public function process(CommandInterface $command): void;

    /**
     * Returns the whole data that contains all elements to each steps of the workflow.
     *
     * @return stdClass
     */
    public function getData(): stdClass;

    /**
     * Returns the Command object given to the workflow.
     *
     * @return CommandInterface
     */
    public function getCommand(): CommandInterface;
}
