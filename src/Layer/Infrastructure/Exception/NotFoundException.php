<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception Class NotFoundException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class NotFoundException extends Exception
{
    /**
     * @param string $message
     * @param Exception|null $previous
     */
    public function __construct($message = '', Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND, $previous);
    }

    /**
     * Returns the <No Result For Id> Exception.
     *
     * @param string|array $id
     * @return NotFoundException
     */
    public static function noResultForId($id): NotFoundException
    {
        if (\is_array($id)) {
            $id = \implode(', ', $id);
        }
        return new static(\sprintf('No result found for id: %s.', $id));
    }

    /**
     * Returns the <No Result For Id with Rev> Exception.
     *
     * @param string $id
     * @param string $rev
     * @param Exception|null $previous
     * @return NotFoundException
     */
    public static function noResultForIdWithRevision($id, $rev, Exception $previous = null): NotFoundException
    {
        return new static(\sprintf('No result found for id: %s with revision %s.', $id, $rev), $previous);
    }
}
