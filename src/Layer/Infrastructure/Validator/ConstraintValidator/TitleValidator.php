<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Title;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Class TitleValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class TitleValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var Title $constraint */
        self::checkConstraintType($constraint, Title::class);

        if (!\is_string($value) || !\preg_match($constraint->getRegex(), $value)) {
            $this->context->addViolation($constraint->message, ['%string%' => $value]);
        }
    }
}
