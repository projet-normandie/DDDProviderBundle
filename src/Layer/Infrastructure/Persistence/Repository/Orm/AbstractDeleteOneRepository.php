<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use stdClass;

/**
 * Abstract Class AbstractDeleteOneRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractDeleteOneRepository extends AbstractRepository
{
    /**
     * @param stdClass $object
     * @return mixed
     */
    public function execute(stdClass $object)
    {
        return $this->remove($object->entityId);
    }

    /**
     * @param $entityId
     * @return mixed
     */
    protected function remove($entityId)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->delete($this->entityName, 'a')
            ->andWhere('a.id = ?1')
            ->setParameter(1, $entityId);

        //execute post_query_builder processor
        $this->executeProcess('post_query_builder', $qb);

        return $qb->getQuery()->execute();
    }
}
