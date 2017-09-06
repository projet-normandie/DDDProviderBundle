<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Comparison;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\AbstractLeafSpecification;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer\AbstractValueTokenizer;

/**
 * Class NotInSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Comparison
 */
class NotInSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'not in';

    /**
     * NotInSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['string'])->checkValueTypeOf(['string', 'integer', 'double', 'array']);

        //Cast the value as an array to check the integrity of the sub-values.
        $this->setValue((array)$this->getValue());
        \array_walk($this->value, static function ($valueElement, $index) {
            static::checkSubTypeOf('value', ['string', 'integer', 'double'], $index, $valueElement);
        });
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        return '(' . $this->field . ' NOT IN (' . $this->value . '))';
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
     * Overwrites the behavior of this method to handle specific case of NOT IN operator that expects an array.
     *
     * @param AbstractValueTokenizer $valueTokenizer Specific object that will tokenize parameter values according to
     *                                               the database type (ORM, ODM or CouchDB).
     * @return AbstractLeafSpecification
     */
    public function manageValue(AbstractValueTokenizer $valueTokenizer): AbstractLeafSpecification
    {
        $this->addParameter(0, $this->value);
        $this->value = $valueTokenizer->tokenize($this->getParameters());

        return $this;
    }
}
