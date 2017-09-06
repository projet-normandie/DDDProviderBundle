<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\FieldsDefinition\FieldsDefinitionAbstract;

/**
 * Interface CriteriaManagerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager
 */
interface CriteriaManagerInterface
{
    /**
     * @return FieldsDefinitionAbstract
     */
    public function getFieldsDefinition(): FieldsDefinitionAbstract;

    /**
     * Manages a specification to replace criteria fields by database field names.
     *
     * @param SpecificationInterface $specification
     * @return SpecificationInterface
     */
    public function manageSpecification(SpecificationInterface $specification): SpecificationInterface;
}
