<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\PhoneNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PhoneNumberValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class PhoneNumberValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var PhoneNumber $constraint */
        self::checkConstraintType($constraint, PhoneNumber::class);

        if (!\is_string($value) || !\preg_match($constraint->getRegex(), $value)) {
            $this->context->addViolation($constraint->message, ['%string%' => $value]);
        }
    }
}
