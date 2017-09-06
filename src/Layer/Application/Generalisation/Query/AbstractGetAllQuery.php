<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Limit;

/**
 * Abstract Class AbstractGetAllQuery.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Query
 * @abstract
 */
abstract class AbstractGetAllQuery implements QueryInterface
{
    /**
     * @var Limit
     */
    protected $limit;

    /**
     * @param Limit $limit
     */
    public function __construct(Limit $limit)
    {
        $this->setLimit($limit);
    }

    /**
     * @return Limit
     */
    public function getLimit(): Limit
    {
        return $this->limit;
    }

    /**
     * @param Limit $limit
     * @return AbstractGetAllQuery
     */
    public function setLimit(Limit $limit): AbstractGetAllQuery
    {
        $this->limit = $limit;
        return $this;
    }
}
