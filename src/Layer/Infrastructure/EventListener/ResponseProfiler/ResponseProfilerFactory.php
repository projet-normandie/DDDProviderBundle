<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener\ResponseProfiler;

use Nicodev\Asserts\TraitAssertArray;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidArgumentException;

/**
 * Class ResponseProfilerFactory
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener\ResponseProfiler
 */
class ResponseProfilerFactory
{
    use TraitAssertArray;

    /** @var string JSON format code from the Symfony\Component\HttpFoundation\Response object. */
    /*public*/ const FORMAT_JSON = 'json';

    /** @var string XML format code from the Symfony\Component\HttpFoundation\Response object. */
    /*public*/ const FORMAT_XML = 'xml';

    /**
     * List of concrete ResponseProfiler that can be built using this factory.
     * @var string[]
     */
    protected static $responseProfilerList = [
        self::FORMAT_JSON => JsonResponseProfiler::class,
        self::FORMAT_XML => XmlResponseProfiler::class,
    ];

    /**
     * Return the right instance of an ResponseProfilerInterface object or null if not in the available list.
     *
     * @param string $requestFormat
     * @return ResponseProfilerInterface
     * @throws InvalidArgumentException
     */
    public static function build(string $requestFormat): ResponseProfilerInterface
    {
        $responseProfilerName = static::assertKeyExists(
            self::$responseProfilerList,
            $requestFormat,
            InvalidArgumentException::invalidArgument()
        );

        return new $responseProfilerName;
    }
}
