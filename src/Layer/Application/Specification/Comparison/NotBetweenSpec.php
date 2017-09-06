<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Comparison;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\AbstractLeafSpecification;

/**
 * Class NotBetweenSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Comparison
 */
class NotBetweenSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'not between';

    /** @var int Exact number of sub-properties expected in the "value" property. */
    /*protected*/ const EXPECTED_NB_VALUES = 2;

    /**
     * NotBetweenSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['string'])
            ->checkValueTypeOf(['array'])
            ->checkValueCount();

        // Ensure each element of value are "string", "integer" or "double".
        \array_walk($value, static function ($valueElement, $index) {
            static::checkSubTypeOf('value', ['string', 'integer', 'double'], $index, $valueElement);
        });
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        [$leftOperand, $rightOperand] = $this->value;
        return '(' . $this->field . ' NOT BETWEEN ' . $leftOperand . ' AND ' . $rightOperand . ')';
    }

    /**
     * {@inheritdoc}
     */
    public function renderOdm(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function renderCouchDB(): string
    {
        return '';
    }
}
