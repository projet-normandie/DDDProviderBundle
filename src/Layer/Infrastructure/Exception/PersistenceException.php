<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;

/**
 * Exception Class PersistenceException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class PersistenceException extends Exception
{
    /**
     * Returns the <Missing Entity Id> Exception.
     *
     * @return PersistenceException
     */
    public static function missingEntityId(): PersistenceException
    {
        return new static('entityIds cannot be empty');
    }
}
