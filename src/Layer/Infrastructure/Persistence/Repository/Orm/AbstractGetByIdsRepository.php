<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PersistenceException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm\Query;
use stdClass;

/**
 * Abstract Class AbstractGetByIdsRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractGetByIdsRepository extends AbstractRepository
{
    use TraitAssertCountable;

    /**
     * @param stdClass $object
     * @return mixed
     * @throws PersistenceException
     */
    public function execute(stdClass $object)
    {
        return $this->findByIds($object->entityIds);
    }

    /**
     * @param array $entityIds
     * @return mixed Null or entity
     * @throws PersistenceException
     */
    protected function findByIds(array $entityIds)
    {
        static::assertNotEmpty($entityIds, PersistenceException::missingEntityId());

        $qb = $this->em->createQueryBuilder();
        $qb->select('a')
            ->from($this->entityName, 'a')
            ->where('a.id IN (?1)')
            ->setParameter(1, $entityIds);

        //execute post_query_builder processor
        $this->executeProcess('post_query_builder', $qb);

        return (new Query($qb))->getResults();
    }
}
