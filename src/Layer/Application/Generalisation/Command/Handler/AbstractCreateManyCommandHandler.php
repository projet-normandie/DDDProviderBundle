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
 * Abstract Class AbstractCreateManyCommandHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command\Handler
 * @abstract
 */
abstract class AbstractCreateManyCommandHandler implements CommandHandlerInterface
{
    use TraitElementPointer;
    use TraitAssertObject;

    /**
     * @var WorkflowHandlerInterface Workflow Handler that will process the Command to notify each observers.
     */
    protected $workflowHandler;

    /**
     * Constructs the CreateManyCommandHandler containing the Workflow Handler.
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
     * @return EntityInterface[]
     * @throws WorkflowException
     */
    public function process(CommandInterface $command): array
    {
        $this->workflowHandler->process($command);

        $entities = self::getLastElement($this->workflowHandler->getData()->entity);
        return static::assertObjectNotFalse($entities, WorkflowException::noCreatedEntity());
    }
}
