<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler\ResponseProfilerFactory;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler\RequestProfiler;

/**
 * Class HandlerResponseProfiler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener
 */
class HandlerResponseProfiler
{
    /**
     * @param FilterResponseEvent $event
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function onKernelResponse(FilterResponseEvent $event): void
    {
        try {
            $request = RequestProfiler::getRequest($event);
            $responseProfiler = ResponseProfilerFactory::build($request->getRequestFormat());
        } /** @noinspection BadExceptionsProcessingInspection */ catch (InvalidArgumentException $e) {
            //In this case, we want to ignore if the request is bad or the factory cannot build the responseProfiler.
            return;
        }

        $response = $event->getResponse();
        $prettyPrintLang = $responseProfiler->getPrettyPrintClass();

        $content = <<<HTML
<html><body>
    <pre class="{$prettyPrintLang}">{$responseProfiler->parseContent($response)}</pre>
</body></html>
HTML;

        $response->setContent($content);

        // Set the request type to HTML
        $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
        $request->setRequestFormat('html');

        // Overwrite the original response
        $event->setResponse($response);
    }
}
