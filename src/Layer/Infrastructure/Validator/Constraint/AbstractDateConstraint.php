<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

/**
 * Abstract Class AbstractDateConstraint
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 * @abstract
 */
abstract class AbstractDateConstraint extends AbstractConstraint
{
    /**
     * @var string Code of the Invalid Time Date Error.
     */
    /*public*/ const INVALID_TIME_DATE_ERROR = 'a299fc78-6548-45a3-9823-898c07f76c9b';

    /**
     * @var string[] Error code names.
     */
    protected static $errorNames = [
        self::INVALID_TIME_DATE_ERROR => 'INVALID_TIME_DATE_ERROR'
    ];

    /**
     * @var string
     */
    public $message;

    /**
     * @var bool If true, same day is accepted
     */
    public $equal = false;

    /**
     * @var int
     */
    public $dayDelay = 0;
}
