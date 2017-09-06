<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\ValueObject\Generalisation;

/**
 * Interface ValueObjectInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage ValueObject\Generalisation
 */
interface ValueObjectInterface
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * Check the equality of the current Vo with another Vo passed by argument.
     * @param ValueObjectInterface $vo
     * @return bool
     */
    public function isEqual(ValueObjectInterface $vo): bool;

    /**
     * Check if the current Vo is empty, meaning all of its properties are NULL.
     * @return bool
     */
    public function isEmpty(): bool;
}
