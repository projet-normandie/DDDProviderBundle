<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Command;

use Nicodev\Asserts\TraitAssertComparison;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\NotFoundException;
use stdClass;

/**
 * Class DeleteOneManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Command
 */
class DeleteOneManager extends AbstractCommandManager
{
    use TraitAssertComparison;

    /**
     * @param stdClass $object
     * @return int
     * @throws \ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException
     * @throws NotFoundException
     */
    public function process(stdClass $object): int
    {
        $result = $this->factory
            ->buildRepository(RepositoryFactoryInterface::DELETE_ONE_REPOSITORY)
            ->execute($object);

        return static::assertStrictNotEquals($result, 0, NotFoundException::noResultForId($object->entityId));
    }
}
