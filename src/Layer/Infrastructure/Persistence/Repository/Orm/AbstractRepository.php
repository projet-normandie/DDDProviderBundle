<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessorInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\TraitProcessor;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\RepositoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\ClassName\TraitEntityNameRepository;

/**
 * Abstract Class AbstractRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractRepository implements RepositoryInterface, ProcessorInterface
{
    use TraitProcessor;
    use TraitEntityNameRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var string $entityName
     */
    protected $entityName;

    /**
     * @var string $alias
     */
    protected $alias = 'a';


    /**
     * Initializes a new AbstractSaveRepository.
     *
     * @param EntityManagerInterface $em The EntityManager to use.
     * @param string $entityName The name of the entity to use in this repository.
     */
    public function __construct(EntityManagerInterface $em, string $entityName)
    {
        $this->em = $em;
        $this->entityName = $entityName;
    }
}
