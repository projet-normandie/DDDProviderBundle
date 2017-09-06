<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm\Query;
use stdClass;

/**
 * Abstract Class AbstractGetOneRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractGetOneRepository extends AbstractRepository
{
    /**
     * @param stdClass $object
     * @return mixed
     */
    public function execute(stdClass $object)
    {
        return $this->find($object->entityId);
    }

    /**
     * @param $entityId
     * @return mixed Null or entity
     */
    protected function find($entityId)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('a')
            ->from($this->entityName, 'a')
            ->where('a.id = ?1')
            ->setParameter(1, $entityId);

        //execute post_query_builder processor
        $this->executeProcess('post_query_builder', $qb);

        return (new Query($qb))->getResult();
    }
}
