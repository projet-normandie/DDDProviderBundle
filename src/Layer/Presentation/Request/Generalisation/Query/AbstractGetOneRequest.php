<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query;

/**
 * Abstract Class AbstractGetOneRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Query
 * @abstract
 */
abstract class AbstractGetOneRequest extends AbstractQueryRequest
{
    /**
     * @var array
     */
    protected $required = ['entityId'];

    /**
     * @var array
     */
    protected $allowedTypes = ['entityId' => ['string']];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];

        $this->setOptionFromQuery('entityId');

        return $this;
    }
}
