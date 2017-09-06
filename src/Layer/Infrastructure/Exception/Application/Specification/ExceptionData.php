<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification;

/**
 * Class ExceptionData
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception\Application\Specification
 */
class ExceptionData
{
    /** @var string Operator where the exception occurs. */
    protected $operator;

    /** @var string Property name which is invalid, so the exception will occur. */
    protected $propertyName;

    /** @var string|null Sub-property name which is invalid, if defined, so the exception will occur. */
    protected $subPropertyName;

    /** @var string[] List of expected types for the value of the current parsed field. */
    protected $expectedTypes;

    /**
     * ExceptionData constructor.
     *
     * @param string $operator
     * @param string $propertyName
     * @param null|string[] $expectedTypes
     */
    public function __construct($operator, $propertyName, ?array $expectedTypes = null)
    {
        $this->operator = $operator;
        $this->propertyName = $propertyName;
        $this->expectedTypes = $expectedTypes;
    }

    /**
     * @param string $operator
     * @return ExceptionData
     */
    public function setOperator(string $operator): ExceptionData
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @param string $propertyName
     * @return ExceptionData
     */
    public function setPropertyName(string $propertyName): ExceptionData
    {
        $this->propertyName = $propertyName;
        return $this;
    }

    /**
     * @param null|string $subPropertyName
     * @return ExceptionData
     */
    public function setSubPropertyName(?string $subPropertyName): ExceptionData
    {
        $this->subPropertyName = $subPropertyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpectedTypes(): string
    {
        if (null === $this->expectedTypes) {
            return '';
        }

        return '"' . \implode('", "', $this->expectedTypes) . '"';
    }

    /**
     * @param string[] $expectedTypes
     * @return ExceptionData
     */
    public function setExpectedTypes(array $expectedTypes): ExceptionData
    {
        $this->expectedTypes = $expectedTypes;
        return $this;
    }

    /**
     * Renders the given message using all properties of the ExceptionData values.
     * In the message, parameters must be define with numbers such as:
     * - "%1$s" is the "operator" property
     * - "%2$s" is the "propertyName" property
     * - "%3$s" is the "subPropertyName" property
     * - "%4$s" is the "expectedTypes" property
     *
     * @param string $msg
     * @return string
     */
    public function render(string $msg): string
    {
        return \sprintf($msg, $this->operator, $this->propertyName, $this->subPropertyName, $this->getExpectedTypes());
    }
}
