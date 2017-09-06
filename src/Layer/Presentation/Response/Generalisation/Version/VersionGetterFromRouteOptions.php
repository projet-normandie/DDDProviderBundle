<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class VersionGetterFromRouteOptions
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\Version
 */
class VersionGetterFromRouteOptions implements VersionGetterInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * SerializerStrategy constructor.
     * @param RequestInterface $request
     * @param RouterInterface $router
     */
    public function __construct(RequestInterface $request, RouterInterface $router)
    {
        $this->request = $request;
        $this->router = $router;
    }

    /**
     * Returns the request.
     *
     * @return RequestInterface
     */
    protected function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Returns the router.
     *
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion(): ?int
    {
        $routeName = $this->getRequest()->get('_route');
        $route = $this->getRouter()->getRouteCollection()->get($routeName);

        if (null === $route) {
            return null;
        }

        $version = $route->getOption('_version');
        return null !== $version ? (int)$version : null;
    }
}
