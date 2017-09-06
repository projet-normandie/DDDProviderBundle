<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Limit;

/**
 * Abstract Class AbstractGetAllRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Query
 * @abstract
 */
abstract class AbstractGetAllRequest extends AbstractQueryRequest
{
    /**
     * @var array
     */
    protected $defaults = [
        'limit' => ['start' => 0, 'count' => 100]
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'limit' => [Limit::class],
    ];

    /**
     * {@inheritdoc}
     */
    protected function process(): void
    {
        $this->allowedValues['limit'] = Limit::getClosureValidation();
        parent::process();
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    protected function setOptions()
    {
        $this->options = [];

        $limit = [
            'start' => (int)$this->request->get('start', $this->defaults['limit']['start']),
            'count' => (int)$this->request->get('count', $this->defaults['limit']['count'])
        ];
        $this->options['limit'] = new Limit($limit);

        return $this;
    }
}
