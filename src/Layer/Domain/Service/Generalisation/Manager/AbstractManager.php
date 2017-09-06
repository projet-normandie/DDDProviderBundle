<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Logger\Generalisation\TraitLogger;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\FieldsDefinition\FieldsDefinitionAbstract;

/**
 * Abstract Class AbstractManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager
 * @abstract
 */
abstract class AbstractManager implements ManagerInterface
{
    use TraitLogger;

    /**
     * @var RepositoryFactoryInterface
     */
    protected $factory;

    /**
     * @var FieldsDefinitionAbstract
     */
    protected $fieldsDefinition;

    /**
     * @param RepositoryFactoryInterface $factory
     * @param FieldsDefinitionAbstract $fieldsDefinition
     */
    public function __construct(RepositoryFactoryInterface $factory, FieldsDefinitionAbstract $fieldsDefinition)
    {
        $this->factory = $factory;
        $this->fieldsDefinition = $fieldsDefinition;
    }

    /**
     * @return FieldsDefinitionAbstract
     */
    public function getFieldsDefinition(): FieldsDefinitionAbstract
    {
        return $this->fieldsDefinition;
    }

    /**
     * @param \stdClass $object
     * @return mixed
     */
    abstract public function process(\stdClass $object);
}
