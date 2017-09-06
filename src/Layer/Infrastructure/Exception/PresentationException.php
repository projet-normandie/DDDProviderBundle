<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception Class PresentationException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class PresentationException extends Exception
{
    /**
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message = '', Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST, $previous);
    }

    /**
     * Returns the <Invalid Json Request> Exception.
     *
     * @return PresentationException
     */
    public static function invalidJsonRequest(): PresentationException
    {
        return new static('Invalid Json in request');
    }

    /**
     * Returns the <Invalid Patch Request> Exception.
     *
     * @return PresentationException
     */
    public static function invalidPatchRequest(): PresentationException
    {
        return new static('Invalid request for method Patch: at least entityId and one field to patch');
    }
}
