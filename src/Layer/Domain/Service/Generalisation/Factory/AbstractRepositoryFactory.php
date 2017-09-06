<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory;

use Nicodev\Asserts\TraitAssertArray;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\TraitProcessor;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessorInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\RepositoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException;

/**
 * Abstract Class AbstractRepositoryFactory
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Factory
 * @abstract
 */
abstract class AbstractRepositoryFactory implements RepositoryFactoryInterface, ProcessorInterface
{
    use TraitRepositoryFactory;
    use TraitProcessor;
    use TraitAssertArray;

    /**
     * @var string[] List of Repository names the factory is able to load. Define it into each repository factories.
     */
    /*protected*/ const FACTORY_LIST = [];

    /**
     * Get the name of the repository to create based on the given action name.
     *
     * @param string $action Action related to the repository the factory wants to create.
     * @return string Name of the repository the factory wants to create.
     * @throws DomainException Only if the given action is not one of the expected to find the repository name.
     */
    protected function getRepositoryClass(string $action): string
    {
        $exception = DomainException::wrongKeyForRepositoryFactory($action);
        return static::assertKeyExists(static::FACTORY_LIST, $action, $exception);
    }

    /**
     * Add processors if the repository has the addProcess() method
     *
     * @param RepositoryInterface $repository
     */
    protected function addProcessor(RepositoryInterface $repository): void
    {
        if (isset($this->process['post_query_builder'])) {
            $repository->addProcesses('post_query_builder', $this->process['post_query_builder']);
        }
    }
}
