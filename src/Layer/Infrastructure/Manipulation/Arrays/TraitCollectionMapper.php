<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\Arrays;

use Doctrine\Common\Collections\Collection;

/**
 * Trait TraitCollectionMapper
 *
 * Utilities for collections, array or iterator to be mapped easily.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\Arrays
 */
trait TraitCollectionMapper
{
    /**
     * Applies a callback to each element of the collection if the given collection is a Doctrine collection.
     *
     * @param mixed $collection Collection that must be a Doctrine collection, or NULL will be returned.
     * @param string|array $callback Name of the function or array containing the class and the method that is the
     *                               callback to use for mapping through each element of the collection.
     * @return array|null
     */
    public function mapDoctrineCollection($collection, $callback): ?array
    {
        if (!$collection instanceof Collection) {
            return null;
        }
        return \array_map($callback, \iterator_to_array($collection));
    }
}
