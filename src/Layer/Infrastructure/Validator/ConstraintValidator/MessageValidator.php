<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Message;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class MessageValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class MessageValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var Message $constraint */
        self::checkConstraintType($constraint, Message::class);

        if (!\is_string($value) || !\preg_match($constraint->getRegex(), $value)) {
            $this->context->addViolation($constraint->message, ['%string%' => $value]);
        }
    }
}
