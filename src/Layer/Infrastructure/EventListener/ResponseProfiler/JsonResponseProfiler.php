<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class JsonResponseProfiler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener\ResponseProfiler
 */
class JsonResponseProfiler implements ResponseProfilerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPrettyPrintClass(): string
    {
        return 'prettyprint lang-js';
    }

    /**
     * {@inheritdoc}
     */
    public function parseContent(Response $response): string
    {
        return \htmlspecialchars(\json_encode(\json_decode($response->getContent()), \JSON_PRETTY_PRINT));
    }
}
