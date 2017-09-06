<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandValidationHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Abstract Class AbstractCommandValidationHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Validation\ValidationHandler
 * @abstract
 */
abstract class AbstractCommandValidationHandler implements CommandValidationHandlerInterface
{
    use TraitAssertCountable;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var array
     */
    protected $constraints;

    /**
     * @var ConstraintViolationListInterface
     */
    protected $errors;

    /**
     * AbstractCommandValidationHandler constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->constraints = [];
        $this->validator = $validator;
    }

    /**
     * @param CommandInterface $command
     * @return bool
     * @throws ValidationException
     */
    public function process(CommandInterface $command): bool
    {
        $this->initConstraints();
        $this->errors = $this->validator->validateValue($command->toArray(true), $this->getConstraints());
        return static::assertEmpty($this->errors, ValidationException::validationFailed($this->getErrors()));
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return ValidationErrorHandler::arrayAll($this->errors);
    }

    /**
     * @return void Init array of constraints [field_name => constraints, field_name => constraints, ...]
     */
    abstract protected function initConstraints(): void;

    /**
     * @param $field
     * @param $constraints
     * @return $this
     */
    protected function add($field, $constraints)
    {
        $this->constraints[$field] = $constraints;
        return $this;
    }

    /**
     * @return array
     */
    protected function getConstraints(): array
    {
        return $this->constraints;
    }
}
