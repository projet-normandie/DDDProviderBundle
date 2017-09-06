<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\AbstractDeleteOneCommand;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\PersistenceException;
use stdClass;

/**
 * Abstract Class AbstractDeleteManyRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractDeleteManyRepository extends AbstractRepository
{
    use TraitAssertCountable;

    /**
     * @param stdClass $object
     * @return mixed
     * @throws PersistenceException
     */
    public function execute(stdClass $object)
    {
        return $this->removeMany($object->deleteOneCommands);
    }

    /**
     * @param AbstractDeleteOneCommand[] $commands
     * @return mixed
     * @throws PersistenceException
     */
    protected function removeMany($commands)
    {
        $entityIds = [];
        foreach ($commands as $command) {
            $entityIds[] = $command->getEntityId();
        }
        static::assertNotEmpty($entityIds, PersistenceException::missingEntityId());

        $qb = $this->em->createQueryBuilder();
        $qb->delete($this->entityName, 'a')
            ->andWhere('a.id IN (?1)')
            ->setParameter(1, $entityIds);

        //execute post_query_builder processor
        $this->executeProcess('post_query_builder', $qb);

        return $qb->getQuery()->execute();
    }
}
