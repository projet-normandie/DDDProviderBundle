<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\TypeHinting;

use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use stdClass;

/**
 * Trait TraitStdClass
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\TypeHinting
 */
trait TraitStdClass
{
    /**
     * Returns a stdClass object representation of the given array.
     *
     * @param array $array
     * @return stdClass
     */
    public static function buildFromArray(array $array): stdClass
    {
        return (object)$array;
    }

    /**
     * Returns a stdClass object representation of the given object, using all its properties.
     *
     * @param object $object
     * @return stdClass
     */
    public static function buildFromObject($object): stdClass
    {
        $stdClass = new stdClass();
        foreach ((new ReflectionObject($object))->getProperties() as $oProperty) {
            $oProperty->setAccessible(true);
            $stdClass->{$oProperty->getName()} = $oProperty->getValue($object);
        }

        return $stdClass;
    }

    /**
     * Returns a stdClass object representation of the given object filtered based on a class definition.
     *
     * @param object $object
     * @param string $basedOn
     * @return stdClass
     * @throws ReflectionException
     */
    public static function buildFromDestination($object, string $basedOn): stdClass
    {
        return (object)\array_intersect_key(
            (array)self::buildFromObject($object),
            \array_flip(\array_column((new ReflectionClass($basedOn))->getProperties(), 'name'))
        );
    }
}
