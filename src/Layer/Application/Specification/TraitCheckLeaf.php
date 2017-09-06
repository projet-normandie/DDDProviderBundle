<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

use Nicodev\Asserts\{TraitAssertArray, TraitAssertCountable, TraitAssertType};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification\ExceptionData;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification\{
    SpecNumberPropertyException, SpecPropertyException
};

/**
 * Trait TraitCheckLeaf
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 */
trait TraitCheckLeaf
{
    use TraitAssertType, TraitAssertCountable, TraitAssertArray {
        TraitAssertType::makeAssertion insteadof TraitAssertCountable;
        TraitAssertType::makeAssertion insteadof TraitAssertArray;
    }

    /**
     * Checks if the field is one of the given types. Throws exception otherwise.
     *
     * @param string[] $allowedTypes The list of expected types.
     * @return AbstractLeafSpecification
     */
    protected function checkFieldTypeOf(array $allowedTypes): AbstractLeafSpecification
    {
        static::assertIsTypeOf($allowedTypes, $this->field, $this->prepareFieldInvalidException($allowedTypes));
        return $this;
    }

    /**
     * Checks if the value is one of the given types. Throws exception otherwise.
     *
     * @param string[] $allowedTypes The list of expected types.
     * @return AbstractLeafSpecification
     */
    protected function checkValueTypeOf(array $allowedTypes): AbstractLeafSpecification
    {
        static::assertIsTypeOf($allowedTypes, $this->value, $this->prepareValueInvalidException($allowedTypes));
        return $this;
    }

    /**
     * Checks if the sub-field or sub-value is one of the given types. Throws exception otherwise.
     *
     * @param string $property Type of the property ('field', 'value', ...).
     * @param string[] $allowedTypes The list of expected types.
     * @param int|string $index The index of the sub-field or the sub-value.
     * @param mixed $sub The sub field/value.
     */
    protected static function checkSubTypeOf(string $property, array $allowedTypes, $index, $sub): void
    {
        $data = (new ExceptionData(static::IDENTIFIER, $property, $allowedTypes))->setSubPropertyName((string)$index);
        static::assertIsTypeOf($allowedTypes, $sub, SpecPropertyException::invalidSub($data, $sub));
    }

    /**
     * Checks if the sub-field or sub-value is one of the given name. Throws exception otherwise.
     *
     * @param string $property Type of the property ('field', 'value', ...).
     * @param string[] $expectedNames The list of expected names.
     * @param int|string $name The name/index of the sub-property to check.
     */
    protected static function checkSubName(string $property, array $expectedNames, $name): void
    {
        $data = (new ExceptionData(static::IDENTIFIER, $property))->setSubPropertyName((string)$name);
        static::assertInArrayStrict($expectedNames, $name, SpecPropertyException::unknownSub($data, $expectedNames));
    }

    /**
     * Checks the number of sub-fields in the field property.
     *
     * @return AbstractLeafSpecification
     */
    protected function checkFieldCount(): AbstractLeafSpecification
    {
        $e = SpecNumberPropertyException::fields(\count($this->field), static::EXPECTED_NB_FIELDS, static::IDENTIFIER);
        static::assertCount($this->field, static::EXPECTED_NB_FIELDS, $e);
        return $this;
    }

    /**
     * Checks the number of sub-fields in the value property.
     *
     * @return AbstractLeafSpecification
     */
    protected function checkValueCount(): AbstractLeafSpecification
    {
        $e = SpecNumberPropertyException::values(\count($this->value), static::EXPECTED_NB_VALUES, static::IDENTIFIER);
        static::assertCount($this->value, static::EXPECTED_NB_VALUES, $e);
        return $this;
    }

    /**
     * Prepares the exception that must be thrown if the field parameter is invalid for the current operator.
     *
     * @param string[] $allowedTypes The list of expected types.
     * @return SpecPropertyException
     */
    protected function prepareFieldInvalidException(array $allowedTypes): SpecPropertyException
    {
        $e = new ExceptionData(static::IDENTIFIER, 'field', $allowedTypes);
        return SpecPropertyException::invalidOne($e, $this->field);
    }

    /**
     * Prepares the exception that must be thrown if the value parameter is invalid for the current operator.
     *
     * @param string[] $allowedTypes The list of expected types.
     * @return SpecPropertyException
     */
    protected function prepareValueInvalidException(array $allowedTypes): SpecPropertyException
    {
        $e = new ExceptionData(static::IDENTIFIER, 'value', $allowedTypes);
        return SpecPropertyException::invalidOne($e, $this->value);
    }
}
