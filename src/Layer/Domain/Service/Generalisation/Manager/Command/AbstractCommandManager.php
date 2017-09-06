<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Command;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessorInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\TraitProcessor;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\AbstractManager;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\TypeHinting\TraitStdClass;

/**
 * Abstract Class AbstractCommandManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Command
 * @abstract
 */
abstract class AbstractCommandManager extends AbstractManager implements ProcessorInterface
{
    use TraitProcessor;
    use TraitStdClass;

    /**
     * Executes the process method. Entry point for every command actions in the manager.
     *
     * @param EntityInterface $entity
     * @return $this
     * @throws DomainException
     */
    protected function execute(EntityInterface $entity)
    {
        return $this->persist(self::buildFromArray(['entity' => $entity]));
    }

    /**
     * Persists the object that contains the entity.
     * Will execute processes before and after the ask of the persistence by the repository.
     *
     * @param \stdClass $stdObject Unformed object that contains the entity and its id.
     * @return $this
     * @throws DomainException
     */
    public function persist(\stdClass $stdObject)
    {
        //Execute pre-persist processor
        $this->executeProcess('pre_persist_update', $stdObject->entity);

        //Persistence handler
        $this->factory->buildRepository(RepositoryFactoryInterface::SAVE_REPOSITORY)->execute($stdObject);

        //Execute post-persist processor
        $this->executeProcess('post_persist_update', $stdObject->entity);

        return $this;
    }
}
