<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ResponseProfilerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener\ResponseProfiler
 */
interface ResponseProfilerInterface
{
    /**
     * Return the HTML class name of the pretty-print language style.
     *
     * @return string
     */
    public function getPrettyPrintClass(): string;

    /**
     * Parse the content of the response to fit with the expected format.
     *
     * @param Response $response
     * @return string
     */
    public function parseContent(Response $response): string;
}
