<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PresentationException;

/**
 * Abstract Class AbstractDeleteManyRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Command
 * @abstract
 */
abstract class AbstractDeleteManyRequest extends AbstractCommandRequest
{
    /**
     * @var array
     */
    protected $defaults = [
        'revision' => ''
    ];

    /**
     * @var array
     */
    protected $required = ['entityId'];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'entityId' => ['string'],
        'revision' => ['string']
    ];

    /**
     * Processes the options to set the resolver and the request parameters.
     *
     * @throws PresentationException
     * @throws \LogicException
     */
    protected function process(): void
    {
        $this->setOptions();
        if (0 === \count($this->options)) {
            throw PresentationException::invalidJsonRequest();
        }

        $this->resolver->setDefaults($this->defaults);
        $this->resolver->setRequired($this->required);
        \array_map([$this->resolver, 'setAllowedTypes'], \array_keys($this->allowedTypes), $this->allowedTypes);

        $this->requestParameters = \array_map([$this->resolver, 'resolve'], $this->options);
    }
}
