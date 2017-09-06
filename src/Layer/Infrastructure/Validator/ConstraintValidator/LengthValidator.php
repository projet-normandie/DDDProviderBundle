<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Length;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class LengthValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class LengthValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritdoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var Length $constraint */
        self::checkConstraintType($constraint, Length::class);

        $limitMin = $constraint->getMin();
        $limitMax = $constraint->getMax();
        $size = \mb_strlen($value);

        // Check the minimum length.
        if (null !== $limitMin && $size < $constraint->getMin()) {
            $this->context->addViolation(
                $constraint->messages[Length::MIN_ERROR],
                ['%value%', $value, '%minLength%', $constraint->getMin()]
            );
        }

        // Check the maximum length.
        if (null !== $limitMax && $size > $constraint->getMax()) {
            $this->context->addViolation(
                $constraint->messages[Length::MAX_ERROR],
                ['%value%', $value, '%maxLength%', $constraint->getMax()]
            );
        }
    }
}
