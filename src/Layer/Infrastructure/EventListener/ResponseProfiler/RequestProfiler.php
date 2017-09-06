<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler;

use Nicodev\Asserts\TraitAssertBoolean;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class RequestProfiler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener\ResponseProfiler
 */
class RequestProfiler
{
    use TraitAssertBoolean;

    /**
     * Try to return the request if the requester allows it.
     *
     * @param FilterResponseEvent $event
     * @throws InvalidArgumentException
     * @throws \InvalidArgumentException
     * @return HttpRequest
     */
    public static function getRequest(FilterResponseEvent $event): HttpRequest
    {
        static::assertTrue($event->isMasterRequest(), InvalidArgumentException::invalidArgument());

        $request = $event->getRequest();

        // Only send back HTML if the requester allows it
        static::assertTrue($request->query->get('_profiler'), InvalidArgumentException::invalidArgument());

        $headerAccept = (string)$request->headers->get('Accept');
        $condition = (false !== \strpos($headerAccept, 'text/html') || false !== \strpos($headerAccept, '*/*'));
        static::assertTrue($condition, InvalidArgumentException::invalidArgument());

        return $request;
    }
}
