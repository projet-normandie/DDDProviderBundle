<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Doctrine\ORM\QueryBuilder;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\QueryInterface;

/**
 * Class Query
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Generalisation\Orm
 */
class Query implements QueryInterface
{
    /**
     * @var QueryBuilder $queryBuilder
     */
    protected $queryBuilder;

    /**
     * Query constructor.
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        $result = $this->queryBuilder->getQuery()->getResult();
        if (empty($result)) {
            return null;
        }

        return \end($result);
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->queryBuilder->getQuery()->getResult();
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalCount(): int
    {
        $this->queryBuilder->select($this->queryBuilder->expr()->count(1))
            ->setFirstResult(null)
            ->setMaxResults(null);

        return (int)$this->queryBuilder->getQuery()->getSingleScalarResult();
    }
}
