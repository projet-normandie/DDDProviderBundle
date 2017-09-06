<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessorInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\TraitProcessor;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\RepositoryInterface;
use stdClass;

/**
 * Abstract Class AbstractSaveRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractSaveRepository implements RepositoryInterface, ProcessorInterface
{
    use TraitSave;
    use TraitProcessor;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Initializes a new AbstractSaveRepository.
     *
     * @param EntityManagerInterface $em The EntityManager to use.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param stdClass $object
     * @return mixed
     */
    public function execute(stdClass $object)
    {
        return $this->save($object->entity);
    }
}
