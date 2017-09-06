<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query;

/**
 * Abstract Class AbstractGetByIdsRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Query
 * @abstract
 */
abstract class AbstractGetByIdsRequest extends AbstractQueryRequest
{
    /**
     * @var array
     */
    protected $required = ['entityIds'];

    /**
     * @var array
     */
    protected $allowedTypes = ['entityIds' => ['string']];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];

        $this->setOptionFromQuery('entityIds');

        return $this;
    }
}
