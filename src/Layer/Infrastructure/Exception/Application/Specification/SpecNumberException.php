<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\SpecException;

/**
 * Exception Class SpecNumberException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception\Application\Specification
 */
class SpecNumberException extends SpecException
{
    /**
     * @param string $operator
     * @param int $nbSpecExpected
     * @param int $nbSpecActual
     * @return SpecNumberException
     */
    public static function notEnough(string $operator, int $nbSpecExpected, int $nbSpecActual): SpecNumberException
    {
        $msg = 'The logical operator "%1$s" must be an aggregation of at least %2$d %4$s, %3$d given.';
        return static::buildNumberSpecifications($msg, [$operator, $nbSpecExpected, $nbSpecActual]);
    }

    /**
     * @param string $operator
     * @param int $nbSpecExpected
     * @param int $nbSpecActual
     * @return SpecNumberException
     */
    public static function tooMany(string $operator, int $nbSpecExpected, int $nbSpecActual): SpecNumberException
    {
        $msg = 'The logical operator "%1$s" must be an aggregation of at most %2$d %4$s, %3$d given.';
        return static::buildNumberSpecifications($msg, [$operator, $nbSpecExpected, $nbSpecActual]);
    }

    /**
     * @param string $operator
     * @param int $nbSpecExpected
     * @param int $nbSpecActual
     * @return SpecNumberException
     */
    public static function invalidNumber(string $operator, int $nbSpecExpected, int $nbSpecActual): SpecNumberException
    {
        $msg = 'The logical operator "%1$s" must be an aggregation of exactly %2$d %4$s, %3$d given.';
        return static::buildNumberSpecifications($msg, [$operator, $nbSpecExpected, $nbSpecActual]);
    }

    /**
     * Builds the exceptions messages about bad number of them by mapping the replacements.
     *
     * @param string $msg The message to fill by replacements.
     * @param array $replacements Array of all replacements to apply.
     * @return SpecNumberException
     */
    protected static function buildNumberSpecifications(string $msg, array $replacements): SpecNumberException
    {
        [$operator, $nbSpecExpected, $nbSpecActual] = $replacements;
        $plural = ['specification', 'specifications'][$nbSpecExpected > 1];
        return new static(\sprintf($msg, $operator, $nbSpecExpected, $nbSpecActual, $plural));
    }
}
