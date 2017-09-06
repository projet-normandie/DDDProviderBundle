<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Distance;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractLeafSpecification, SpecificationInterface
};
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;

/**
 * Class SpaceDistanceSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Distance
 */
class SpaceDistanceSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'space distance';

    /** @var int Exact number of sub-properties expected in the "field" property. */
    /*protected*/ const EXPECTED_NB_FIELDS = 3;

    /** @var int Exact number of sub-properties expected in the "value" property. */
    /*protected*/ const EXPECTED_NB_VALUES = 4;

    /**
     * SpaceDistanceSpec constructor.
     *
     * @param mixed $field
     * @param mixed $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value);

        $this->checkFieldTypeOf(['array'])
            ->checkValueTypeOf(['array'])
            ->checkFieldCount()
            ->checkValueCount();

        $this->checkFieldSubProperties()->checkValueSubProperties();
    }

    /**
     * {@inheritdoc}
     *
     */
    public function renderOrm(): string
    {
        ['x' => $xOrigin, 'y' => $yOrigin, 'z' => $zOrigin, 'distance' => $distance] = $this->value;
        ['x' => $xField, 'y' => $yField, 'z' => $zField] = $this->field;

        // Operation to get the shortest distance between 2 points in space is:
        // Δ = √( (x-x')² + (y-y')² + (z-z')²)
        // Where:
        // - Δ is the distance between two points (in origin units)
        // - x, y and z are the references position point on the x-axis, y-axis and z-axis
        // - x', y' and z' are the origins position point on the x-axis, y-axis and z-axis
        $mathOperation = ' SQRT('
            . ' ((' . $xField . ' - ' . $xOrigin . ') * (' . $xField . ' - ' . $xOrigin . ')) +'
            . ' ((' . $yField . ' - ' . $yOrigin . ') * (' . $yField . ' - ' . $yOrigin . ')) +'
            . ' ((' . $zField . ' - ' . $zOrigin . ') * (' . $zField . ' - ' . $zOrigin . ')) '
            . ') ';

        return '(' . $distance . ' >= ' . $mathOperation . ')';
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
     * {@inheritdoc}
     */
    public function manageSpecificationForManager(CriteriaManagerInterface $manager): SpecificationInterface
    {
        return $this->setField(\array_map([$manager->getFieldsDefinition(), 'getField'], $this->getField()));
    }

    /**
     * Ensures each element of field are of the expected types and subProperty names are correct.
     *
     * @return SpaceDistanceSpec
     */
    protected function checkFieldSubProperties(): SpaceDistanceSpec
    {
        \array_walk($this->field, static function ($subField, $name) {
            // Check that the name of the sub-property is expected then the type of the subField.
            static::checkSubName('field', ['x', 'y', 'z'], $name);
            static::checkSubTypeOf('field', ['string'], $name, $subField);
        });

        return $this;
    }

    /**
     * Ensures each element of value are of the expected types and subProperty names are correct.
     *
     * @return SpaceDistanceSpec
     */
    protected function checkValueSubProperties(): SpaceDistanceSpec
    {
        \array_walk($this->value, static function ($subValue, $name) {
            // Check that the name of the sub-property is expected then the type of the subValue.
            static::checkSubName('value', ['x', 'y', 'z', 'distance'], $name);
            static::checkSubTypeOf('value', ['integer', 'double'], $name, $subValue);
        });

        return $this;
    }
}
