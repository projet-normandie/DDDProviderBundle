<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\OccurrenceRegex;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class OccurrenceRegexValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class OccurrenceRegexValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritdoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var OccurrenceRegex $constraint */
        self::checkConstraintType($constraint, OccurrenceRegex::class);

        $regex = $constraint->getRegex();
        if (empty($regex)) {
            return;
        }

        $nbOccurrence = \preg_match_all($regex, $value);

        // Check the minimum length.
        if (!$constraint->respectMin($nbOccurrence)) {
            $this->context->addViolation(
                $constraint->messages[OccurrenceRegex::MIN_ERROR],
                ['%value%', $value, '%min%', $constraint->getMin()]
            );
        }

        // Check the maximum length.
        if (!$constraint->respectMax($nbOccurrence)) {
            $this->context->addViolation(
                $constraint->messages[OccurrenceRegex::MAX_ERROR],
                ['%value%', $value, '%max%', $constraint->getMax()]
            );
        }
    }
}
