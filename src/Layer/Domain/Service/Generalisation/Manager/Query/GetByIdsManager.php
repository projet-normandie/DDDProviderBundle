<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Query;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\NotFoundException;
use stdClass;

/**
 * Class GetByIdsManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Query
 */
class GetByIdsManager extends AbstractQueryManager
{
    use TraitAssertCountable;

    /**
     * @param stdClass $object
     * @return \ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface[]
     * @throws \ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException
     * @throws NotFoundException
     */
    public function process(stdClass $object): array
    {
        $entities = $this->factory
            ->buildRepository(RepositoryFactoryInterface::GET_BY_IDS_REPOSITORY)
            ->execute($object);

        static::assertNotEmpty($entities, NotFoundException::noResultForId($object->entityIds));
        return $entities;
    }
}
