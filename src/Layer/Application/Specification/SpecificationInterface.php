<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidArgumentException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\CriteriaRepositoryInterface;

/**
 * Interface SpecificationInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications
 */
interface SpecificationInterface
{
    /**
     * Renders the string to handle the specification for ORM.
     *
     * @return string
     */
    public function renderOrm(): string;

    /**
     * Renders the string to handle the specification for ODM.
     *
     * @return string
     */
    public function renderOdm(): string;

    /**
     * Renders the string to handle the specification for CouchDB.
     *
     * @return string
     */
    public function renderCouchDB(): string;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * Manages a specification to replace criteria fields by database field names.
     *
     * @param CriteriaManagerInterface $manager
     * @return SpecificationInterface
     * @throws InvalidArgumentException
     */
    public function manageSpecificationForManager(CriteriaManagerInterface $manager): SpecificationInterface;

    /**
     * Manages a specification to add aliases to criteria fields and tokenize criteria values according to a given
     * repository.
     *
     * @param CriteriaRepositoryInterface $repository
     * @return SpecificationInterface
     */
    public function manageSpecificationForRepository(CriteriaRepositoryInterface $repository): SpecificationInterface;
}
