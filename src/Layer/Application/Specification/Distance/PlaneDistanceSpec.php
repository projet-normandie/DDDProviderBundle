<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Distance;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractLeafSpecification, SpecificationInterface
};
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;

/**
 * Class PlaneDistanceSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification\Distance
 */
class PlaneDistanceSpec extends AbstractLeafSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'plane distance';

    /** @var int Exact number of sub-properties expected in the "field" property. */
    /*protected*/ const EXPECTED_NB_FIELDS = 2;

    /** @var int Exact number of sub-properties expected in the "value" property. */
    /*protected*/ const EXPECTED_NB_VALUES = 3;

    /**
     * PlaneDistanceSpec constructor.
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
        ['x' => $xOrigin, 'y' => $yOrigin, 'distance' => $distance] = $this->value;
        ['x' => $xField, 'y' => $yField] = $this->field;

        // Operation to get the shortest distance between 2 points on a plane is:
        // Δ = √( (x-x')² + (y-y')² )
        // Where:
        // - Δ is the distance between two points (in origin units)
        // - x is the reference position point on the x-axis and y the reference position point on the y-axis
        // - x' is the origin position point on the x-axis and y' the origin position point on the y-axis
        $mathOperation = ' SQRT('
            . ' ((' . $xField . ' - ' . $xOrigin . ') * (' . $xField . ' - ' . $xOrigin . ')) +'
            . ' ((' . $yField . ' - ' . $yOrigin . ') * (' . $yField . ' - ' . $yOrigin . ')) '
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
     * @return PlaneDistanceSpec
     */
    protected function checkFieldSubProperties(): PlaneDistanceSpec
    {
        \array_walk($this->field, static function ($subField, $name) {
            // Check that the name of the sub-property is expected then the type of the subField.
            static::checkSubName('field', ['x', 'y'], $name);
            static::checkSubTypeOf('field', ['string'], $name, $subField);
        });

        return $this;
    }

    /**
     * Ensures each element of value are of the expected types and subProperty names are correct.
     *
     * @return PlaneDistanceSpec
     */
    protected function checkValueSubProperties(): PlaneDistanceSpec
    {
        \array_walk($this->value, static function ($subValue, $name) {
            // Check that the name of the sub-property is expected then the type of the subValue.
            static::checkSubName('value', ['x', 'y', 'distance'], $name);
            static::checkSubTypeOf('value', ['integer', 'double'], $name, $subValue);
        });

        return $this;
    }
}
