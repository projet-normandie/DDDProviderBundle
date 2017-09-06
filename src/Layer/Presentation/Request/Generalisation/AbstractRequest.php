<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation;

use LogicException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PresentationException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Resolver\ResolverInterface;

/**
 * Abstract Class AbstractRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation
 * @abstract
 */
abstract class AbstractRequest
{
    use TraitRequestOptions;

    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * @var array
     */
    protected $allowedTypes = [];

    /**
     * @var array
     */
    protected $allowedValues = [];

    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param RequestInterface $request
     * @param ResolverInterface $resolver
     * @throws PresentationException
     * @throws LogicException
     */
    public function __construct(RequestInterface $request, ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        $this->request  = $request;

        $this->process();
    }

    /**
     * @return array
     */
    public function getRequestParameters(): array
    {
        return $this->requestParameters;
    }

    /**
     * method that applies defaults[], required[] and allowedTypes[]
     * on the resolver and calls its resolve method
     * @throws PresentationException
     * @throws LogicException
     */
    protected function process(): void
    {
        $this->setOptions();

        $this->resolver->setDefaults($this->defaults);
        $this->resolver->setRequired($this->required);
        \array_map([$this->resolver, 'setAllowedTypes'], \array_keys($this->allowedTypes), $this->allowedTypes);
        \array_map([$this->resolver, 'setAllowedValues'], \array_keys($this->allowedValues), $this->allowedValues);

        $this->requestParameters = $this->resolver->resolve($this->options);
    }

    /**
     * Returns the body of the request decoded in JSON.
     *
     * @return mixed
     * @throws LogicException
     */
    protected function getBody()
    {
        return \json_decode($this->request->getContent(), true);
    }
}
