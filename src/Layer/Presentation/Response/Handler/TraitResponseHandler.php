<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Handler;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Serializer\SerializerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version\VersionGetterInterface;

/**
 * Trait TraitResponseHandler.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Handler
 */
trait TraitResponseHandler
{

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var VersionGetterInterface
     */
    protected $versionGetter;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * ResponseHandler constructor.
     *
     * @param SerializerInterface $serializer
     * @param RequestInterface $request
     * @param VersionGetterInterface $versionGetter
     * @throws \LogicException
     */
    public function __construct(
        SerializerInterface $serializer,
        RequestInterface $request,
        VersionGetterInterface $versionGetter
    ) {
        $this->setRequest($request)
            ->setVersionGetter($versionGetter)
            ->setSerializer($serializer);
    }

    /**
     * Sets the RequestInterface object.
     *
     * @param RequestInterface $request
     *
     * @return ResponseHandler
     */
    protected function setRequest(RequestInterface $request): ResponseHandler
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Gets the RequestInterface object.
     *
     * @return RequestInterface
     */
    protected function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Sets the VersionInterface object.
     *
     * @param VersionGetterInterface $versionGetter
     * @return $this
     */
    protected function setVersionGetter($versionGetter)
    {
        $this->versionGetter = $versionGetter;
        return $this;
    }

    /**
     * Gets the VersionInterface object.
     *
     * @return VersionGetterInterface
     */
    protected function getVersionGetter(): VersionGetterInterface
    {
        return $this->versionGetter;
    }

    /**
     * Gets the format.
     *
     * @return string|null
     */
    protected function getFormat(): ?string
    {
        return $this->getRequest()->getRequestFormat();
    }

    /**
     * Gets the serialization
     *
     * @return SerializerInterface
     */
    protected function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    /**
     * @param SerializerInterface $serializer
     * @return $this
     * @throws \LogicException
     */
    protected function setSerializer(SerializerInterface $serializer)
    {
        // Set the version of the serializer.
        $serializer->getSerializationContext()
            ->setVersion($this->getVersionGetter()->getVersion())
            ->setSerializeNull(true);

        $this->serializer = $serializer;

        return $this;
    }
}
