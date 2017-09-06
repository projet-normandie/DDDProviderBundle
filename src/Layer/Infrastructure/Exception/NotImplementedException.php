<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception Class NotImplementedException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class NotImplementedException extends Exception
{
    /**
     * NotImplementedException constructor.
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message = '', Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_NOT_IMPLEMENTED, $previous);
    }

    /**
     * @return NotImplementedException
     */
    public static function notImplementedYet(): NotImplementedException
    {
        return new static('Not implemented yet.');
    }
}
