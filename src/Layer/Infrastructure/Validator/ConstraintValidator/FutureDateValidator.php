<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\FutureDate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\{
    ConstraintDefinitionException, InvalidOptionsException, MissingOptionsException, UnexpectedTypeException
};

/**
 * Class FutureDateValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class FutureDateValidator extends AbstractDateValidator
{
    use TraitValidator;

    /**
     * {@inheritdoc}
     * @throws MissingOptionsException
     * @throws InvalidOptionsException
     * @throws ConstraintDefinitionException
     * @throws UnexpectedTypeException
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var FutureDate $constraint */
        self::checkConstraintType($constraint, FutureDate::class);

        $this->checkDateComparison($value, $constraint);
    }
}
