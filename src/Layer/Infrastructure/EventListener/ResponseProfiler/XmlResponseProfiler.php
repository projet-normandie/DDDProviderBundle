<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class XmlResponseProfiler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener\ResponseProfiler
 */
class XmlResponseProfiler implements ResponseProfilerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPrettyPrintClass(): string
    {
        return 'prettyprint lang-xml';
    }

    /**
     * {@inheritdoc}
     */
    public function parseContent(Response $response): string
    {
        return \htmlspecialchars($response->getContent());
    }
}
