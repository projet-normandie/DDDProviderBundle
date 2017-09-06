<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

/**
 * Class Length
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class Length extends AbstractConstraint
{

    /** @var string Code of the error when the length of a string is not respecting a minimum size. */
    /*public*/ const MIN_ERROR = 'MIN_ERROR';

    /** @var string Code of the error when the length of a string is not respecting a maximum size. */
    /*public*/ const MAX_ERROR = 'MAX_ERROR';

    /**
     * @var string[] List of default messages available for this constraint.
     */
    public $messages = [
        self::MIN_ERROR => 'String "%value%" must contains at least "%minLength%" characters',
        self::MAX_ERROR => 'String "%value%" must contains at most "%maxLength%" characters',
    ];

    /**
     * @var string Specific message that can be defined to overwrite possible default message.
     */
    public $message = 'The given value is not a string';

    /**
     * @var int|null If defined, minimum length of the value.
     */
    protected $min;

    /**
     * @var int|null If defined, maximum length of the value.
     */
    protected $max;

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }
}
