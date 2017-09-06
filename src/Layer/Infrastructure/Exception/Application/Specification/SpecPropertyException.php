<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\SpecException;

/**
 * Exception Class SpecPropertyException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception\Application\Specification
 */
class SpecPropertyException extends SpecException
{
    /**
     * @param ExceptionData $exceptionData
     * @param mixed $element
     * @return SpecPropertyException
     */
    public static function invalidOne(ExceptionData $exceptionData, $element): SpecPropertyException
    {
        $msg = $exceptionData->render('The property "%2$s" beside the "%1$s" operator must be of type %4$s: ');
        return static::buildInvalidProperty($msg, $element);
    }

    /**
     * @param ExceptionData $exceptionData
     * @param mixed $element
     * @return SpecPropertyException
     */
    public static function invalidSub(ExceptionData $exceptionData, $element): SpecPropertyException
    {
        $msg = 'The sub-property "%3$s" inside property "%2$s", beside the "%1$s" operator, must be of type %4$s: ';
        $msg = $exceptionData->render($msg);
        return static::buildInvalidProperty($msg, $element);
    }

    /**
     * @param ExceptionData $exceptionData
     * @param array $allowedSubProperties
     * @return SpecPropertyException
     */
    public static function unknownSub(ExceptionData $exceptionData, array $allowedSubProperties): SpecPropertyException
    {
        $msg = 'Unknown sub-property "%3$s" inside property "%2$s", beside the "%1$s" operator. ';
        $msg = $exceptionData->render($msg) . 'Allowed sub-properties are %s.';

        return new static(\sprintf($msg, '"' . \implode('", "', $allowedSubProperties) . '"'));
    }

    /**
     * Builds the exception message by managing the end of the message depending on the $element.
     *
     * @param string $msg The start of the message to complete by using this method.
     * @param mixed $element If NULL, the end of the message will be different from the classical message.
     * @return SpecPropertyException
     */
    protected static function buildInvalidProperty(string $msg, $element): SpecPropertyException
    {
        $possibleMsg = [
            \sprintf($msg . '"%s" given.', \gettype($element)), // If $element is not NULL.
            $msg . 'but is missing or NULL.',                   // If $element is NULL.
        ];
        return new static($possibleMsg[null === $element]);
    }
}
