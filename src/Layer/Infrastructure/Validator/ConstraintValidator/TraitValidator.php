<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use Nicodev\Asserts\TraitAssertObject;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use Symfony\Component\Validator\Constraint;

/**
 * Trait TraitValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
trait TraitValidator
{
    use TraitAssertObject;

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @throws ValidationException
     */
    abstract public function validate($value, Constraint $constraint): void;

    /**
     * Check the type of the constraint to oblige the concrete validator to work with the good constraint object.
     *
     * @param Constraint $constraint
     * @param string $expectedConstraint
     * @throws ValidationException
     */
    public static function checkConstraintType(Constraint $constraint, string $expectedConstraint): void
    {
        $exception = ValidationException::unexpectedConstraint($constraint, $expectedConstraint);
        static::assertObjectIsA($constraint, $expectedConstraint, $exception);
    }
}
