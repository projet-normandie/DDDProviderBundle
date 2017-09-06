<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Comparison;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\AbstractLeafSpecification;

/**
 * Class GreaterThanSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Comparison
 */
class GreaterThanSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = '>';

    /**
     * GreaterThanSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['string'])->checkValueTypeOf(['string', 'integer', 'double']);
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        return '(' . $this->field . ' > ' . $this->value . ')';
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
