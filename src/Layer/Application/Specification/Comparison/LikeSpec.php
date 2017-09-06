<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Comparison;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\AbstractLeafSpecification;

/**
 * Class LikeSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Comparison
 */
class LikeSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'like';

    /**
     * LikeSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['string'])->checkValueTypeOf(['string']);
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        return '(' . $this->field . ' LIKE ' . $this->value . ')';
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
