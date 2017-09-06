<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Id;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class IdValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class IdValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var Id $constraint */
        self::checkConstraintType($constraint, Id::class);

        if (!\is_string($value) || !\preg_match($constraint->getRegex(), $value)) {
            $this->context->addViolation($constraint->message, ['%string%' => $value]);
        }
    }
}
