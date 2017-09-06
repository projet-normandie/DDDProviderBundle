<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;

/**
 * Class VersionGetterFromRequestVariable
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\Version
 */
class VersionGetterFromRequestVariable implements VersionGetterInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * SerializerStrategy constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Returns the request
     *
     * @return RequestInterface
     */
    protected function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion(): ?int
    {
        $version = $this->getRequest()
            ->get('_version');

        return null !== $version ? (int)$version : null;
    }
}
