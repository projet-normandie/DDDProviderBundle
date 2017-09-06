<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\Handler\Decorator;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandValidationHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\SpecificationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;

/**
 * Abstract Class AbstractCommandHandlerDecorator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command\Handler\Decorator
 * @abstract
 */
abstract class AbstractCommandHandlerDecorator implements CommandHandlerInterface
{
    /**
     * @var CommandHandlerInterface
     */
    protected $commandHandler;

    /**
     * @var CommandValidationHandlerInterface
     */
    protected $validationHandler;

    /**
     * AbstractCommandHandlerDecorator constructor.
     *
     * @param CommandHandlerInterface $commandHandler
     * @param CommandValidationHandlerInterface $validationHandler
     */
    public function __construct(
        CommandHandlerInterface $commandHandler,
        CommandValidationHandlerInterface $validationHandler
    ) {
        $this->commandHandler = $commandHandler;
        $this->validationHandler = $validationHandler;
    }

    /**
     * Method to decorate (override)
     *
     * @param CommandInterface $command
     * @return EntityInterface|EntityInterface[]
     * @throws SpecificationException
     * @throws ValidationException
     */
    public function process(CommandInterface $command)
    {
        $this->validationHandler->process($command);

        return $this->commandHandler->process($command);
    }
}
