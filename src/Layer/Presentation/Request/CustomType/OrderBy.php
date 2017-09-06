<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType;

use Nicodev\Asserts\{TraitAssertArray, TraitAssertCountable, TraitAssertType};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidCustomTypeException as InvalidCustomTypeEx;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Generalisation\AbstractCustomType;

/**
 * Class OrderBy
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType
 */
class OrderBy extends AbstractCustomType
{
    use TraitAssertType, TraitAssertCountable, TraitAssertArray {
        TraitAssertType::makeAssertion insteadof TraitAssertArray;
        TraitAssertType::makeAssertion insteadof TraitAssertCountable;
    }

    /** @var array */
    protected $orders = [];

    /**
     * OrderBy constructor.
     *
     * Checks the structure of expected value for this parameter.
     * Example:
     * "orderBy": [
     *  # First field to sort by:
     *  {
     *     "field": "field.name"    #Mandatory, must be a valid field name.
     *     "asc": true              #Optional, but if defined, must be a boolean. Defaults to TRUE.
     *  },
     *  #Second field to sort by:
     *  {...}
     * ]
     *
     * @param null|array $subProperties
     * @throws \Exception
     */
    public function __construct(?array $subProperties)
    {
        $subProperties = (array)$subProperties;

        foreach ($subProperties as $name => $order) {
            static::assertIsArray($order, InvalidCustomTypeEx::invalidOrderByRequestNotArray($name, $order));
            $field = static::assertKeyExists(
                $order,
                'field',
                InvalidCustomTypeEx::missingRequiredField('orderBy', 'field')
            );
            $asc = $order['asc'] ?? true;

            unset($order['field'], $order['asc']);
            static::assertEmpty($order, InvalidCustomTypeEx::unknownExtraFields('orderBy', $order));

            $this->addOrder($field, $asc);
        }
    }

    /**
     * Returns the list of orders.
     *
     * @return array
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param array $orders
     * @return OrderBy
     */
    public function setOrders(array $orders): OrderBy
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * Adds a field and a way of sorting in a list of order by sections.
     *
     * @param string $field
     * @param bool $asc
     * @return OrderBy
     */
    public function addOrder(string $field, bool $asc): OrderBy
    {
        $this->orders[] = ['field' => $field, 'asc' => $asc];
        return $this;
    }

    /**
     * Validates the integrity of all orders added in the list of orders.
     *
     * @return bool
     */
    public function validate(): bool
    {
        // Check all orders integrity. If no orders, no sorting but it's valid.
        // Key "field" must be defined to a real field, meaning this is not empty.
        return \count($this->orders) === \count(\array_filter(\array_column($this->orders, 'field')));
    }
}
