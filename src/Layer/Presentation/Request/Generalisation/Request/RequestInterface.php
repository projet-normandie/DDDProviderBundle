<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface RequestInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Request
 */
interface RequestInterface
{
    /**
     * Returns the request instance
     *
     * @return Request|null
     */
    public function getInstance(): ?Request;

    /**
     * Returns the request body content.
     *
     * @param bool $asResource If true, a resource will be returned
     * @return string|resource The request body content or a resource to read the body stream.
     * @throws \LogicException
     */
    public function getContent(bool $asResource = false);

    /**
     * Gets a "parameter" value.
     *
     * This method is mainly useful for libraries that want to provide some flexibility.
     *
     * @param string $key     the key
     * @param mixed  $default the default value
     * @param bool   $deep    is parameter deep in multidimensional array
     * @return mixed
     */
    public function get(string $key, $default = null, bool $deep = false);

    /**
     * Gets the request format.
     *
     * Here is the process to determine the format:
     *
     *  * format defined by the user (with setRequestFormat())
     *  * _format request parameter
     *  * $default
     *
     * @param string $default The default format
     * @return string The request format
     */
    public function getRequestFormat(string $default = 'json'): string;

    /**
     * Gets the mime type associated with the format.
     *
     * @param string $format The format
     * @return null|string The associated mime type (null if not found)
     */
    public function getMimeType(string $format): ?string;

    /**
     * Sets the locale.
     *
     * @param string $locale
     * @return RequestInterface
     */
    public function setLocale(string $locale): RequestInterface;

    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale(): string;

    /**
     * Returns true if the request is a XMLHttpRequest.
     *
     * It works if your JavaScript library sets an X-Requested-With HTTP header.
     * It is known to work with common JavaScript frameworks:
     *
     * @link http://en.wikipedia.org/wiki/List_of_Ajax_frameworks#JavaScript
     * @return bool true if the request is an XMLHttpRequest, false otherwise
     */
    public function isXmlHttpRequest(): bool;
}
