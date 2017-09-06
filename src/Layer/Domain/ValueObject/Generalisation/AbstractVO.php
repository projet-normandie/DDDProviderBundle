<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\ValueObject\Generalisation;

/**
 * Abstract Class AbstractVO
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage ValueObject\Generalisation
 * @abstract
 */
abstract class AbstractVO implements ValueObjectInterface
{
    /**
     * Empty final private constructor as this object is immutable.
     */
    final protected function __construct()
    {
    }

    /**
     * Empty final magic setter as this object is immutable.
     * @param string $name
     * @param mixed $value
     */
    final public function __set(string $name, $value)
    {
    }

    /**
     * Build and return a new instance of child VO.
     * @param \stdClass $arguments
     * @return AbstractVO
     */
    final public static function build(\stdClass $arguments): self
    {
        $oVO = new static();
        foreach ($arguments as $propertyName => $value) {
            $oVO->{$propertyName} = $value;
        }

        return $oVO;
    }

    /**
     * {@inheritdoc}
     */
    final public function isEqual(ValueObjectInterface $vo): bool
    {
        //Specific use of simple equality operator to compare object properties.
        //With the use of strict equality operator, objects references will be different: it will always return false.
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        /** @noinspection TypeUnsafeComparisonInspection */
        return $this == $vo;
    }

    /**
     * {@inheritdoc}
     */
    final public function isEmpty(): bool
    {
        foreach ($this as $value) {
            if (null !== $value) {
                return false;
            }
        }
        return true;
    }

    /**
     * Return a serialized string value of the Vo .
     * @return string
     */
    public function __toString(): string
    {
        return \serialize($this);
    }
}
