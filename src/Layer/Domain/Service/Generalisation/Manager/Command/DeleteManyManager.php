<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Command;

use Nicodev\Asserts\TraitAssertComparison;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\AbstractDeleteOneCommand;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\NotFoundException;
use stdClass;

/**
 * Class DeleteManyManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Command
 */
class DeleteManyManager extends AbstractCommandManager
{
    use TraitAssertComparison;

    /**
     * @param stdClass $object
     * @return mixed
     * @throws \ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException
     * @throws NotFoundException
     */
    public function process(stdClass $object)
    {
        $result = $this->factory
            ->buildRepository(RepositoryFactoryInterface::DELETE_MANY_REPOSITORY)
            ->execute($object);

        $entityIds = [];
        foreach ($object->deleteOneCommands as $command) {
            /** @var $command AbstractDeleteOneCommand */
            $entityIds[] = $command->getEntityId();
        }

        return static::assertStrictNotEquals($result, 0, NotFoundException::noResultForId($entityIds));
    }
}
