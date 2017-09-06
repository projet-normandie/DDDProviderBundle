<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Query;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use stdClass;

/**
 * Class GetAllManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Query
 */
class GetAllManager extends AbstractQueryManager
{
    /**
     * @param stdClass $object
     * @return \ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface[]
     * @throws \ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException
     */
    public function process(stdClass $object): array
    {
        return $this->factory
            ->buildRepository(RepositoryFactoryInterface::GET_ALL_REPOSITORY)
            ->execute($object);
    }
}
