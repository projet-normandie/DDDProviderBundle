<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm\Query;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm\TraitLimit;
use stdClass;

/**
 * Abstract Class AbstractGetAllRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractGetAllRepository extends AbstractRepository
{
    use TraitLimit;

    /**
     * @var QueryBuilder $qb
     */
    protected $qb;

    /**
     * @param stdClass $object
     * @return mixed
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function execute(stdClass $object)
    {
        $this->qb = $this->em->createQueryBuilder();

        $this->setLimit($object->limit);
        return $this->findAll();
    }

    /**
     * @return mixed
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    protected function findAll()
    {
        $this->qb->select(\sprintf('a'))
            ->from($this->entityName, 'a');

        $this->setLimitToQueryBuilder($this->qb);

        //execute post_query_builder processor
        $this->executeProcess('post_query_builder', $this->qb);

        $query = new Query($this->qb);

        return [
            'results' => $query->getResults(),
            'total_rows' => $query->getTotalCount()
        ];
    }
}
