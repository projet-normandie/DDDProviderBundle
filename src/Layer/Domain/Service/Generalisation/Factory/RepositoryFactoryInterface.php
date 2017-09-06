<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException;

/**
 * Interface RepositoryFactoryInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Factory
 */
interface RepositoryFactoryInterface
{
    /** @var string Name of the repository that is used to fetch one entity. */
    /*public*/ const GET_ONE_REPOSITORY = 'getOne';

    /** @var string Name of the repository that is used to fetch all entities. */
    /*public*/ const GET_ALL_REPOSITORY = 'getAll';

    /** @var string Name of the repository that is used to fetch entities by their ids. */
    /*public*/ const GET_BY_IDS_REPOSITORY = 'getByIds';

    /** @var string Name of the repository that is used to delete one entity. */
    /*public*/ const DELETE_ONE_REPOSITORY = 'deleteOne';

    /** @var string Name of the repository that is used to delete many entities. */
    /*public*/ const DELETE_MANY_REPOSITORY = 'deleteMany';

    /** @var string Name of the repository that is used to create, update or patch an entity. */
    /*public*/ const SAVE_REPOSITORY = 'save';

    /** @var string Name of the repository that is used to search an entity by criterion. */
    /*public*/ const SEARCH_BY_REPOSITORY = 'searchBy';

    /**
     * @param string $action
     * @return mixed
     * @throws DomainException
     */
    public function buildRepository(string $action);
}
