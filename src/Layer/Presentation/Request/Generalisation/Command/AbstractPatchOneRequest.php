<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PresentationException;

/**
 * Abstract Class AbstractPatchOneRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Command
 * @abstract
 */
abstract class AbstractPatchOneRequest extends AbstractCommandRequest
{
    /**
     * Sets the options and check there are at least 2 parameters: the id and the field to patch.
     *
     * @return $this
     * @throws PresentationException
     * @throws \LogicException
     */
    protected function setOptions()
    {
        parent::setOptions();
        $keys = \array_keys($this->options);
        if (\count($keys) < 2) {
            throw PresentationException::invalidPatchRequest();
        }
        return $this;
    }
}
