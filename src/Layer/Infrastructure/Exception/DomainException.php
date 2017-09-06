<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;

/**
 * Exception Class DomainException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class DomainException extends Exception
{
    /**
     * Returns the <Wrong Key For Repository Factory> Exception.
     *
     * @param $key string
     *
     * @return DomainException
     */
    public static function wrongKeyForRepositoryFactory($key): DomainException
    {
        return new static(\sprintf('Wrong key "%s" for repository factory', $key));
    }

    /**
     * Returns the <Some Value Object Have Not Been Created> Exception.
     *
     * @return DomainException
     */
    public static function someValueObjectHaveNotBeenCreated(): DomainException
    {
        return new static('Some value object have not been created');
    }

    /**
     * Returns the <Command Type not managed> Exception.
     *
     * @return DomainException
     */
    public static function commandTypeNotManaged(): DomainException
    {
        return new static('command type not managed');
    }
}
