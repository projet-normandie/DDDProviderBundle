<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Color;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ColorValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class ColorValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        self::checkConstraintType($constraint, Color::class);

        /** @var Color $constraint */
        if (!\is_string($value) || !\preg_match($constraint->getRegex(), $value)) {
            $this->context->addViolation($constraint->message, ['%string%' => $value]);
        }
    }
}
