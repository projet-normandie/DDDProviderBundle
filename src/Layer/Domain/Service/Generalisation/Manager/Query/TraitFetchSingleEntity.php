<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Query;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\NotFoundException;
use stdClass;

/**
 * Trait TraitFetchSingleEntity
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Query
 */
trait TraitFetchSingleEntity
{
    use TraitAssertCountable;

    /**
     * Fetches a single entity used by the GetOneManager or any CommandManager dealing with a single entity.
     *
     * @param stdClass $object
     * @throws DomainException
     * @return EntityInterface
     */
    public function fetchSingleEntity(stdClass $object): EntityInterface
    {
        /** @var RepositoryFactoryInterface $factory */
        $factory = $this->factory;

        $entity = $factory->buildRepository(RepositoryFactoryInterface::GET_ONE_REPOSITORY)->execute($object);
        static::assertNotEmpty($entity, NotFoundException::noResultForId($object->entityId));
        return $entity;
    }
}
