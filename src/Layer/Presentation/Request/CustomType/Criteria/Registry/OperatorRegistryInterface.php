<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Registry;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Criterion;

/**
 * Interface OperatorRegistryInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Criteria\Registry
 */
interface OperatorRegistryInterface
{
    /**
     * Returns the list of the registered operators.
     *
     * @return string[]
     */
    public function getOperators(): array;

    /**
     * Sets the name of the class to build as the operator class.
     * If the specified IDENTIFIER const is already known in the list, it will update it.
     *
     * @param string $className
     * @return OperatorRegistryInterface
     */
    public function setOperator(string $className): OperatorRegistryInterface;

    /**
     * Tries to build the given operator specification, if defined.
     *
     * @param Criterion $criterion
     * @return SpecificationInterface
     */
    public function buildOperator(Criterion $criterion): SpecificationInterface;

    /**
     * Tries to build the given operator specification, if defined.
     *
     * @param array $requestCriteria The raw criteria from the request.
     * @param Criteria $criteria The criteria object that knows the business to how resolve the given criteria.
     * @return SpecificationInterface
     */
    public function buildLogicalOperator(array $requestCriteria, Criteria $criteria): SpecificationInterface;
}
