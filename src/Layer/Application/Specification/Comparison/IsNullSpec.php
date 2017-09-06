<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Comparison;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\AbstractLeafSpecification;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer\AbstractValueTokenizer;

/**
 * Class IsNullSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Comparison
 */
class IsNullSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'is null';

    /**
     * IsNullSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['string'])->checkValueTypeOf(['NULL']);
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        return '(' . $this->field . ' IS NULL)';
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

    /**
     * Overwrites the value management as it is useless in the "IS NULL" operation.
     *
     * @param AbstractValueTokenizer $valueTokenizer
     * @return AbstractLeafSpecification
     */
    public function manageValue(AbstractValueTokenizer $valueTokenizer): AbstractLeafSpecification
    {
        return $this;
    }
}
