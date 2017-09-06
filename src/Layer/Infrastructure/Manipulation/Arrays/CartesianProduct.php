<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\Arrays;

/**
 * Class CartesianProduct
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\Arrays
 */
class CartesianProduct
{
    /** @var array Result of the cartesian product calculated. */
    protected $product = [];

    /**
     * Returns the result of the cartesian product.
     *
     * @return array
     */
    public function getProduct(): array
    {
        return $this->product;
    }

    /**
     * Applies a callback using each values of all elements in the calculated cartesian product as argument of the
     * given callback.
     *
     * Example:
     * Product is {(0;5), (1;6), (2;8)}
     * Callback is a function that returns the product of two numbers
     * Result is {(0), (6), (16)}
     *
     * @param string|array|callback $callback Callback to use on each set.
     * @return CartesianProduct
     */
    public function applyCallback($callback): self
    {
        // Replicate the callback information each time the product has elements.
        $callbacks = \array_fill(0, \count($this->product), $callback);

        // Call the callback on each sets of the product and map them.
        $this->product = \array_map('\call_user_func_array', $callbacks, $this->product);

        return $this;
    }

    /**
     * Calculates the cartesian product of a list of sets.
     *
     * Example:
     * Set A = {0; 1; 2}
     * Set B = {x; y}
     * Set C = {9; 8}
     *
     * Operation is (A × B) × C
     * Result is:
     * {(0,x,9), (0,x,8), (0,y,9), (0,y,8), (1,x,9), (1,x,8), (1,y,9), (1,y,8), (2,x,9), (2,x,8), (2,y,9), (2,y,8)}
     *
     * @param array $arrayList List of sets that will be operands of the cartesian product.
     * @return CartesianProduct
     */
    public function multiple(array $arrayList): self
    {
        $this->product = \array_shift($arrayList);
        $this->product = \array_reduce($arrayList, [$this, 'calculateCartesianProduct'], $this->product);

        return $this;
    }

    /**
     * Calculates the cartesian product of only two sets.
     *
     * Example:
     * LeftOperand is "{0; 1; 2}"
     * RightOperand is "{x; y; z}"
     * Result is {(0;x), (0;y), (0;z), (1;x), (1;y), (1;z), (2;x), (2;y), (2;z)}
     *
     * Will use the composition operation through array_reduce to inject each element of the second set into the first
     * set.
     *
     * @param array $leftOperand The first set of the operation.
     * @param array $rightOperand The second set of the operation.
     * @return CartesianProduct
     */
    public function calculate(array $leftOperand, array $rightOperand): self
    {
        // Define the callback to use to inject each element of the right operand.
        $reductionCallback = static function ($initialValue, $currentValue) use ($rightOperand) {
            return \array_merge($initialValue, $this->inject($currentValue, $rightOperand));
        };

        // Applies the callback to the left operand using the right operand.
        // Each element of the left operand will be injected to the list of the right operand.
        $this->product = \array_reduce($leftOperand, $reductionCallback, []);

        return $this;
    }

    /**
     * Injects an element into a set.
     *
     * Example:
     * Element is "5"
     * Set is {0, 1, 2}
     * Result is {(0;5), (1;5), (2;5)}
     *
     * This method is equivalent to a cartesian product between a single value and a set.
     *
     * @param mixed $elementToCross The value to inject in the set.
     * @param array $set The set of elements.
     * @return array The set updated with the element crossed inside.
     */
    protected function inject($elementToCross, array $set): array
    {
        $injectionCallback = static function ($elementOfSet) use ($elementToCross) {

            if (!\is_array($elementToCross)) {
                $elementToCross = [$elementToCross];
            }

            if (!\is_array($elementOfSet)) {
                $elementOfSet = [$elementOfSet];
            }

            return \array_merge($elementToCross, $elementOfSet);
        };

        return \array_map($injectionCallback, $set);
    }
}
