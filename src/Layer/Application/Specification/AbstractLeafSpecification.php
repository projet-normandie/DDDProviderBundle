<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\CriteriaRepositoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer\AbstractValueTokenizer;

/**
 * Abstract Class AbstractLeafSpecification
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 * @abstract
 */
abstract class AbstractLeafSpecification extends AbstractSpecification
{
    use TraitCheckLeaf;

    /**
     * @var int Exact number of sub-properties expected in the "field" property.
     *          Must be overload in each operator if needed.
     */
    /*protected*/ const EXPECTED_NB_FIELDS = 1;

    /**
     * @var int Exact number of sub-properties expected in the "value" property.
     *          Must be overload in each operator if needed.
     */
    /*protected*/ const EXPECTED_NB_VALUES = 1;

    /**
     * @var mixed
     */
    protected $field;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * AbstractLeafSpecification constructor.
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     * @return AbstractLeafSpecification
     */
    public function setField($field): AbstractLeafSpecification
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return AbstractLeafSpecification
     */
    public function setValue($value): AbstractLeafSpecification
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Prefixes the field of the specification by the given alias in argument.
     *
     * @param string $alias The alias that must prefixes the field name where the specification will be applied.
     * @return AbstractLeafSpecification
     */
    public function manageField(string $alias): AbstractLeafSpecification
    {
        if (\is_array($this->field)) {
            \array_walk($this->field, static function (&$field) use ($alias) {
                $field = $alias . '.' . $field;
            });
        } else {
            $this->field = $alias . '.' . $this->field;
        }
        return $this;
    }

    /**
     * Changes the value given in specification by a parameter tag given in argument.
     * Of course, it also adds the value in a parameters list to use it in all database types handled.
     *
     * @param AbstractValueTokenizer $valueTokenizer Specific object that will tokenize parameter values according to
     *                                               the database type (ORM, ODM or CouchDB).
     * @return AbstractLeafSpecification
     */
    public function manageValue(AbstractValueTokenizer $valueTokenizer): AbstractLeafSpecification
    {
        // Manage the copy of the value as an array (if operator have several values).
        $copyValue = [[$this->value], $this->value][\is_array($this->value)];

        // For each values (which are parameters to become), process the following snippet.
        foreach ($copyValue as $index => $value) {
            // First, add the value to the parameter list.
            $this->addParameter($index, $value)
                // Then, prepare the replacement of the value by a specific token according to the database type.
                ->addReplacement($index, $valueTokenizer->tokenize($this->getParameters()));
        }

        // Finally, erase the value by its replacements tokens.
        $this->value = $this->getCleanReplacements();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function manageSpecificationForManager(CriteriaManagerInterface $manager): SpecificationInterface
    {
        return $this->setField($manager->getFieldsDefinition()->getField($this->getField()));
    }

    /**
     * {@inheritdoc}
     */
    public function manageSpecificationForRepository(CriteriaRepositoryInterface $repository): SpecificationInterface
    {
        return $this->manageField($repository->getAlias())->manageValue($repository->getValueTokenizer());
    }
}
