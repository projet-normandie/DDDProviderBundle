<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\SpecException;

/**
 * Exception Class SpecNumberPropertyException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception\Application\Specification
 */
class SpecNumberPropertyException extends SpecException
{
    /**
     * @param int $nbFields
     * @param int $nbExpected
     * @param string $operator
     * @return SpecNumberPropertyException
     */
    public static function fields(int $nbFields, int $nbExpected, string $operator): SpecNumberPropertyException
    {
        $plural = ['field', 'fields'][$nbExpected > 1];
        return static::buildWrongNumber([$operator, $nbExpected, $nbFields, $plural]);
    }

    /**
     * @param int $nbValues
     * @param int $nbExpected
     * @param string $operator
     * @return SpecNumberPropertyException
     */
    public static function values(int $nbValues, int $nbExpected, string $operator): SpecNumberPropertyException
    {
        $plural = ['value', 'values'][$nbExpected > 1];
        return static::buildWrongNumber([$operator, $nbExpected, $nbValues, $plural]);
    }

    /**
     * Builds the exception message by mapping the replacements.
     *
     * @param array $replacements Array of all replacements to apply.
     * @return SpecNumberPropertyException
     */
    protected static function buildWrongNumber(array $replacements): SpecNumberPropertyException
    {
        [$operator, $nbExpected, $nbFields, $plural] = $replacements;
        $msg = 'The "%1$s" operator must have exactly %2$d %4$s, %3$d given.';
        return new static(\sprintf($msg, $operator, $nbExpected, $nbFields, $plural));
    }
}
