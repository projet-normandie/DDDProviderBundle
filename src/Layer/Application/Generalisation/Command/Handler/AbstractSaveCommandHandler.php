<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\Handler;

use Nicodev\Asserts\TraitAssertObject;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\{
    CommandHandlerInterface, CommandInterface
};
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation\WorkflowHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\WorkflowException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Workflow\Generalisation\TraitElementPointer;

/**
 * Abstract Class AbstractSaveCommandHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command\Handler
 * @abstract
 */
abstract class AbstractSaveCommandHandler implements CommandHandlerInterface
{
    use TraitElementPointer;
    use TraitAssertObject;

    /**
     * @var WorkflowHandlerInterface Workflow Handler that will process the Command to notify each observers.
     */
    protected $workflowHandler;

    /**
     * Constructs the CreateOneCommandHandler, UpdateOneCommandHandler or PatchOneCommandHandler
     * containing the Workflow Handler.
     *
     * @param WorkflowHandlerInterface $workflowHandler
     */
    public function __construct(WorkflowHandlerInterface $workflowHandler)
    {
        $this->workflowHandler = $workflowHandler;
    }

    /**
     * Processes all observers given in the workflow handler and retrieves the entity at the end of the workflow
     * process.
     *
     * @param CommandInterface $command
     * @return EntityInterface
     * @throws WorkflowException
     */
    public function process(CommandInterface $command): EntityInterface
    {
        $this->workflowHandler->process($command);

        $entity = self::getLastElement($this->workflowHandler->getData()->entity);
        return static::assertObjectNotFalse($entity, WorkflowException::noCreatedEntity());
    }
}
