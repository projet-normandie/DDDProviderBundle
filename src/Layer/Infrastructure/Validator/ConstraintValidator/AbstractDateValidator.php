<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\FutureDate;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\PastDate;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateValidator;
use Symfony\Component\Validator\Exception\{
    ConstraintDefinitionException, InvalidOptionsException, MissingOptionsException, UnexpectedTypeException
};

/**
 * Abstract Class AbstractDateValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 * @abstract
 */
abstract class AbstractDateValidator extends DateValidator
{
    /**
     * @param $value
     * @return bool
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws ConstraintDefinitionException
     * @throws UnexpectedTypeException
     */
    public function checkRawValue($value): bool
    {
        if (null === $value || '' === $value || $value instanceof \DateTimeInterface) {
            return false;
        }

        parent::validate($value, new Date());

        return !($this->context->getViolations()->count() > 0);
    }

    /**
     * Check that the date is before/after the date defined by the constraint.
     *
     * @param mixed $value
     * @param FutureDate|PastDate $constraint
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws ConstraintDefinitionException
     * @throws UnexpectedTypeException
     */
    public function checkDateComparison($value, $constraint): void
    {
        //Check that $value is a string or an object that can be cast to a string.
        if (!$this->checkRawValue($value)) {
            return;
        }

        //Cast in string to force the usage in DateTime object;
        $value = (string)$value;

        //Define the limit for the validation.
        $dateTimeLimit = new \DateTime('today ' . $constraint->dayDelay . 'day');

        //Execute the comparison with the two dates.
        if ($constraint->compareDate(new \DateTime($value), $dateTimeLimit)) {
            return;
        }

        //If the comparison reveals a violation, add this violation to the context.
        $parameters = [
            '%value%' => $this->formatValue($value),
            '%date%', $this->formatValue($dateTimeLimit->format('Y-m-d')),
        ];
        $this->context->addViolation($constraint->message, $parameters);
    }
}
