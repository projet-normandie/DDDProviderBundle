<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Limit;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\OrderBy;

/**
 * Abstract Class AbstractGetAllQuery.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Query
 * @abstract
 */
abstract class AbstractSearchByQuery implements QueryInterface
{
    /**
     * @var Criteria
     */
    protected $criteria;

    /**
     * @var Limit
     */
    protected $limit;

    /**
     * @var null|OrderBy
     */
    protected $orderBy;

    /**
     * AbstractSearchByQuery constructor.
     *
     * @param Criteria $criteria
     * @param Limit $limit
     * @param null|OrderBy $orderBy
     */
    public function __construct(Criteria $criteria, Limit $limit, ?OrderBy $orderBy = null)
    {
        $this->setCriteria($criteria)
            ->setLimit($limit)
            ->setOrderBy($orderBy);
    }

    /**
     * @return Criteria
     */
    public function getCriteria(): Criteria
    {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return AbstractSearchByQuery
     */
    public function setCriteria(Criteria $criteria): AbstractSearchByQuery
    {
        $this->criteria = $criteria;
        return $this;
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
     * @return AbstractSearchByQuery
     */
    public function setLimit(Limit $limit): AbstractSearchByQuery
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return null|OrderBy
     */
    public function getOrderBy(): ?OrderBy
    {
        return $this->orderBy;
    }

    /**
     * @param null|OrderBy $orderBy
     * @return AbstractSearchByQuery
     */
    public function setOrderBy(?OrderBy $orderBy): AbstractSearchByQuery
    {
        $this->orderBy = $orderBy;
        return $this;
    }
}
