<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Throwable;

/**
 * Exception Class EsbException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class EsbException extends Exception
{
    /**
     * Returns the <Unable to connect to ESB> Exception.
     *
     * @param string $esbName Name of ESB.
     * @param null|Throwable $previous Previous Exception
     * @return EsbException
     */
    public static function unableToConnect($esbName, ?Throwable $previous = null): EsbException
    {
        return new static(\sprintf('Unable to connect to ESB: "%s".', $esbName), 0, $previous);
    }
}
