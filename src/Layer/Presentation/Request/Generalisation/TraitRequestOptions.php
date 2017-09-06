<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation;

use LogicException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PresentationException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;

/**
 * Trait TraitRequestOptions
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation
 */
trait TraitRequestOptions
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @return $this
     * @throws PresentationException
     * @throws LogicException
     */
    protected function setOptions()
    {
        $this->options = $this->getBody();
        if (null === $this->options) {
            throw PresentationException::invalidJsonRequest();
        }
        return $this;
    }

    /**
     * Sets the given option using a given request query parameter.
     *
     * @param string $parameter
     * @param null|string $typeCasting
     * @return $this
     */
    protected function setOptionFromQuery(string $parameter, ?string $typeCasting = null)
    {
        /** @var RequestInterface $request */
        $request = $this->request;

        $this->options[$parameter] = $request->get($parameter, $this->defaults[$parameter] ?? null);
        if (null !== $typeCasting) {
            \settype($this->options[$parameter], $typeCasting);
        }

        return $this;
    }
}
