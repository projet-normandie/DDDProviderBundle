<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class SymfonyStrategy
 * Default Request strategy.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Request
 */
class SymfonyStrategy extends AbstractRequest
{
    /**
     * Request object from Symfony used to fetch HTTP request information.
     * @var Request|null
     */
    protected $request;

    /**
     * SymfonyStrategy constructor.
     *
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        $this->request = $request->getCurrentRequest();
        if (null !== $this->request) {
            $this->setInit();
        }
    }

    /**
     * Get the Request instance.
     *
     * @return Request|null
     */
    public function getInstance(): ?Request
    {
        return $this->request;
    }

    /**
     * Get the content from the Request object.
     *
     * @param bool $asResource
     * @return string|resource
     * @throws \LogicException
     */
    public function getContent(bool $asResource = false)
    {
        return $this->request->getContent($asResource);
    }

    /**
     * Get an element from the query part of the Request.
     *
     * @param string $key
     * @param mixed $default
     * @param bool $deep
     * @return mixed
     */
    public function get(string $key, $default = null, bool $deep = false)
    {
        return $this->request->get($key, $default, $deep);
    }

    /**
     * Accessor for the "_format" implicit parameter of a query Request.
     *
     * @param string $default
     * @return string
     */
    public function getRequestFormat(string $default = 'json'): string
    {
        return $this->request->getRequestFormat($default);
    }

    /**
     * Gets the mime type associated with the format.
     *
     * @param string $format
     * @return string|null
     */
    public function getMimeType(string $format): ?string
    {
        return $this->request->getMimeType($format);
    }

    /**
     * Returns if the current Request is an XmlHttpRequest (or XHR) which is commonly called an AJAX call.
     * @return bool
     */
    public function isXmlHttpRequest(): bool
    {
        return $this->request->isXmlHttpRequest();
    }

    /**
     * Set the locale for the current Request.
     *
     * @param string $locale
     * @return RequestInterface
     */
    public function setLocale(string $locale): RequestInterface
    {
        $this->request->setLocale($locale);
        return $this;
    }

    /**
     * Get the locale from the Request.
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->request->getLocale();
    }

    /**
     * Initialize all properties from the Request.
     *
     * @return $this
     */
    protected function setInit()
    {
        return $this->setCookies()
            ->setQuery()
            ->setHeader()
            ->setAttributes()
            ->setFiles()
            ->setServer();
    }

    /**
     * Set the cookies property from the Request.
     *
     * @return $this
     */
    protected function setCookies()
    {
        $this->cookies = $this->request->cookies;
        return $this;
    }

    /**
     * Set the query property from the Request.
     *
     * @return $this
     */
    protected function setQuery()
    {
        $this->query = $this->request->query;
        return $this;
    }

    /**
     * Set the headers property from the Request.
     *
     * @return $this
     */
    protected function setHeader()
    {
        $this->headers = $this->request->headers;
        return $this;
    }

    /**
     * Set the attributes property from the Request.
     *
     * @return $this
     */
    protected function setAttributes()
    {
        $this->attributes = $this->request->attributes;
        return $this;
    }

    /**
     * Set the files property from the Request.
     *
     * @return $this
     */
    protected function setFiles()
    {
        $this->files = $this->request->files;
        return $this;
    }

    /**
     * Set the server property from the Request.
     *
     * @return $this
     */
    protected function setServer()
    {
        $this->server = $this->request->server;
        return $this;
    }
}
