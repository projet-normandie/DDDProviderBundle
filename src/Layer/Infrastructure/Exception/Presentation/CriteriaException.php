<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Presentation;

use Exception;

/**
 * Exception Class CriteriaException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception\Presentation
 */
class CriteriaException extends Exception
{
    /**
     * @return CriteriaException
     */
    public static function missingCriteria(): CriteriaException
    {
        $msg = <<<EXCEPTION
Missing mandatory "criteria" object. Please use a "criteria" like:
{"criteria": {"operator": "an_valid_operator", "field": "a_db_field", "value": "a_value"}}
EXCEPTION;

        return new static(\sprintf($msg));
    }

    /**
     * @param mixed $invalidKey
     * @return CriteriaException
     */
    public static function invalidCriteriaFormat($invalidKey): CriteriaException
    {
        $msg = 'Invalid format of the "criteria" parameter. '
         . 'Expected either an object with an "operator" key, or a logical operator: "%s" found.';
        return new static(\sprintf($msg, $invalidKey));
    }

    /**
     * @param string $operator
     * @param string[] $available List of available operators.
     * @return CriteriaException
     */
    public static function invalidCriteriaOperator(string $operator, array $available): CriteriaException
    {
        $msg = <<<EXCEPTION
Invalid criteria operation "%s". Please use an existing operator.
Operators available are:
%s
EXCEPTION;

        return new static(\sprintf($msg, $operator, ' - "' . \implode("\",\n - \"", $available) . '".'));
    }

    /**
     * @param string $operator
     * @param string[] $available List of available operators.
     * @return CriteriaException
     */
    public static function invalidCriteriaLogicalOperator(string $operator, array $available): CriteriaException
    {
        $msg = <<<EXCEPTION
Invalid aggregate logical operator "%s". Please use an existing logical operator.
Logical operators available are:
%s
EXCEPTION;

        return new static(\sprintf($msg, $operator, ' - "' . \implode("\",\n - \"", $available) . '".'));
    }
}
