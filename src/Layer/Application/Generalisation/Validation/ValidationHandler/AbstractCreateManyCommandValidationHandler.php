<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\{
    AbstractCreateOneCommand, AbstractCreateManyCommand
};
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Abstract Class AbstractCreateManyCommandValidationHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Validation\ValidationHandler
 * @abstract
 */
abstract class AbstractCreateManyCommandValidationHandler extends AbstractCommandValidationHandler
{
    use TraitAssertCountable;

    /**
     * {@inheritdoc}
     */
    public function process(CommandInterface $commands): bool
    {
        $this->initConstraints();

        /** @var AbstractCreateManyCommand $commands */
        // Call the validation of a command method for each commands of the CreateManyCommand.
        $this->errors = \array_map([$this, 'validateCommand'], $commands->getCreateOneCommands());

        $arrayErrors = $this->getErrors();

        // After filtering the valid commands, if the number of errors is not 0, throw the ValidationException.
        return static::assertEmpty(\array_filter($arrayErrors), ValidationException::validationFailed($arrayErrors));
    }

    /**
     * Retrieves all errors that have occurred during the validation of basics constraints for all commands in the
     * CreateMany command.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return \array_map([ValidationErrorHandler::class, 'arrayAll'], $this->errors);
    }

    /**
     * Validates a command based on the given constraints.
     *
     * @param AbstractCreateOneCommand $command
     * @return ConstraintViolationListInterface
     */
    public function validateCommand(AbstractCreateOneCommand $command): ConstraintViolationListInterface
    {
        return $this->validator->validateValue($command->toArray(true), $this->getConstraints());
    }
}
