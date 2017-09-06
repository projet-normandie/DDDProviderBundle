<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidCustomTypeException;

/**
 * Class Criterion
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Criteria
 */
class Criterion
{
    use TraitAssertCountable;

    /** @var string|array|null */
    protected $field;

    /** @var string */
    protected $operator;

    /** @var string|array|null */
    protected $value;

    /**
     * Criterion constructor.
     *
     * @param array $criterion
     * @throws InvalidCustomTypeException
     */
    public function __construct(array $criterion)
    {
        $this->init('field', $criterion)
            ->init('operator', $criterion)
            ->init('value', $criterion);

        static::assertEmpty($criterion, InvalidCustomTypeException::unknownExtraFields('criteria', $criterion));
    }

    /**
     * Initializes a property of the limit based on the property key, the setter to call and the list of properties.
     *
     * @param string $key Must be "start" or "count".
     * @param array $subCriterion
     * @return Criterion
     */
    protected function init(string $key, array &$subCriterion): Criterion
    {
        $method = 'set' . \ucfirst($key);

        if (\array_key_exists($key, $subCriterion) && \method_exists($this, $method)) {
            $this->{$method}($subCriterion[$key]);
            unset($subCriterion[$key]);
        }

        return $this;
    }

    /**
     * @return array|string|null
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param array|string|null $field
     * @return Criterion
     */
    public function setField($field): Criterion
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     * @return Criterion
     */
    public function setOperator(string $operator): Criterion
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return array|string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array|string|null $value
     * @return Criterion
     */
    public function setValue($value): Criterion
    {
        $this->value = $value;
        return $this;
    }
}
