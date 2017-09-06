<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception Class InvalidCustomTypeException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class InvalidCustomTypeException extends Exception
{
    /**
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message = '', Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST, $previous);
    }

    /**
     * Returns the exception about the custom type "orderBy" when its content is invalid because it is not an array.
     *
     * @param int|string $key
     * @param mixed $value
     * @return InvalidCustomTypeException
     */
    public static function invalidOrderByRequestNotArray($key, $value): InvalidCustomTypeException
    {
        $msg = 'Sub-properties of property "orderBy" must be declared as arrays. ';
        if (\is_numeric($key)) {
            $msg .= 'Value "%s" of type "%s" not allowed here.';
            return new static(\sprintf($msg, $value, \gettype($value)));
        }

        $msg .= 'Key "%s" not allowed here.';
        return new static(\sprintf($msg, $key));
    }

    /**
     * Returns the exception about a missing mandatory sub-property in a property of the request.
     *
     * @param string $propertyName The property name where the mandatory field must be.
     * @param string $fieldName The name of the mandatory field that is missing.
     * @return InvalidCustomTypeException
     */
    public static function missingRequiredField(string $propertyName, string $fieldName): InvalidCustomTypeException
    {
        $msg = 'Sub-properties of property "%s" must own a key called "%s" defining a field as value.';
        return new static(\sprintf($msg, $propertyName, $fieldName));
    }

    /**
     * Returns the exception about receiving unwanted additional parameters in a given property of the request.
     *
     * @param string $propertyName The property name where unwanted extra fields are defined.
     * @param string[] $extraFields The list of extra fields.
     * @return InvalidCustomTypeException
     */
    public static function unknownExtraFields(string $propertyName, array $extraFields): InvalidCustomTypeException
    {
        $msg = 'Sub-properties of values of property "%s" named %s are not allowed and must be removed.';
        return new static(\sprintf($msg, $propertyName, '"' . \implode('", "', \array_keys($extraFields)) . '"'));
    }
}
