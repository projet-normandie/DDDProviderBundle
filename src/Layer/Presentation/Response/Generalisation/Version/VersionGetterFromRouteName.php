<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;

/**
 * Class VersionGetterFromRouteName
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\Version
 */
class VersionGetterFromRouteName implements VersionGetterInterface
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
        $route = $this->getRequest()
            ->get('_route');
        \preg_match('`_[vV](?:ers(?:ion)?)?(\d+)(?:_.*)$`', $route, $matches);

        if (!\array_key_exists(1, $matches)) {
            return null;
        }

        return (int)$matches[1];
    }
}
