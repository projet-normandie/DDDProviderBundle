<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Doctrine\ORM\QueryBuilder;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Limit;

/**
 * Trait TraitLimit
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Generalisation\Orm
 */
trait TraitLimit
{
    /**
     * @var Limit
     */
    protected $limit;

    /**
     * @return Limit
     */
    public function getLimit(): Limit
    {
        return $this->limit;
    }

    /**
     * @param Limit $limit
     * @return $this
     */
    public function setLimit(Limit $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @return $this
     */
    protected function setLimitToQueryBuilder(QueryBuilder $qb)
    {
        $qb->setFirstResult($this->limit->getStart())
            ->setMaxResults($this->limit->getCount());
        return $this;
    }
}
