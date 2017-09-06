<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\PastDate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\{
    ConstraintDefinitionException, InvalidOptionsException, MissingOptionsException, UnexpectedTypeException
};

/**
 * Class PastDateValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class PastDateValidator extends AbstractDateValidator
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
        /** @var PastDate $constraint */
        self::checkConstraintType($constraint, PastDate::class);

        $this->checkDateComparison($value, $constraint);
    }
}
