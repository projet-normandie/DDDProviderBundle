<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Doctrine\ORM\QueryBuilder;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\OrderBy;

/**
 * Trait TraitOrderBy
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Generalisation\Orm
 */
trait TraitOrderBy
{
    /**
     * @var OrderBy
     */
    protected $orderBy;

    /**
     * @return OrderBy
     */
    public function getOrderBy(): OrderBy
    {
        return $this->orderBy;
    }

    /**
     * @param OrderBy $orderBy
     * @return $this
     */
    public function setOrderBy(OrderBy $orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param null|string $alias
     * @return $this
     */
    protected function addOrderByToQueryBuilder(QueryBuilder $qb, ?string $alias = null)
    {
        $alias = !empty($alias) ? $alias . '.' : '';

        foreach ($this->orderBy->getOrders() as $orderIndex => $order) {
            $dql = $alias . $order['field'] . ' ' . ['DESC', 'ASC'][(int)$order['asc']];
            $qb->add('orderBy', $dql, (bool)$orderIndex);
        }

        return $this;
    }
}
