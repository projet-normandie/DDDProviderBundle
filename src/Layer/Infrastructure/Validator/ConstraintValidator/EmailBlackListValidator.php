<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\ConstraintValidator;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\ValidationException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\EmailBlackList;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class EmailBlackListValidator
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\ConstraintValidator
 */
class EmailBlackListValidator extends ConstraintValidator
{
    use TraitValidator;

    /**
     * @var array
     */
    private $blackList = [];

    /**
     * @param array $blackList
     * @return $this
     */
    public function setBlackList(array $blackList)
    {
        $this->blackList = $blackList;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @throws ValidationException
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var EmailBlackList $constraint */
        self::checkConstraintType($constraint, EmailBlackList::class);

        /** @noinspection ShortListSyntaxCanBeUsedInspection PHPStorm bugs with skipped values when used on short array
         *                                                   syntax ([, $domain])
         * todo: Replace when https://youtrack.jetbrains.com/issue/WI-34517 will be fixed
         */
        list(, $domain) = \explode('@', $value, 2);
        if (\in_array($domain, $this->blackList, true)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
