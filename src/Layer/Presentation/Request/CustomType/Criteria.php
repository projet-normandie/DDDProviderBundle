<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, AbstractLeafSpecification, SpecificationInterface
};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidCustomTypeException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Presentation\CriteriaException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Criterion;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Registry\OperatorRegistryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Generalisation\AbstractCustomType;

/**
 * Class Criteria
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType
 */
class Criteria extends AbstractCustomType
{
    /** @var SpecificationInterface */
    protected $specification;

    /** @var OperatorRegistryInterface Registry that contains all leaf operators. */
    protected $operatorRegistry;

    /** @var OperatorRegistryInterface Registry that contains all logical branches operators. */
    protected $logicalOperatorRegistry;

    /**
     * Criteria constructor.
     * @param OperatorRegistryInterface $operatorReg Registry that contains all leaf operators.
     * @param OperatorRegistryInterface $logicalOperatorReg Registry that contains all logical branches operators.
     */
    public function __construct(OperatorRegistryInterface $operatorReg, OperatorRegistryInterface $logicalOperatorReg)
    {
        $this->setOperatorRegistry($operatorReg);
        $this->setLogicalOperatorRegistry($logicalOperatorReg);
    }

    /**
     * Add into Criteria the leaf registry to use when resolving the criteria request.
     *
     * @param OperatorRegistryInterface $operatorRegistry
     * @return $this
     */
    public function setOperatorRegistry(OperatorRegistryInterface $operatorRegistry)
    {
        $this->operatorRegistry = $operatorRegistry;
        return $this;
    }

    /**
     * Add into Criteria the branch registry to use when resolving the criteria request.
     *
     * @param OperatorRegistryInterface $logicalOperatorRegistry
     * @return $this
     */
    public function setLogicalOperatorRegistry(OperatorRegistryInterface $logicalOperatorRegistry)
    {
        $this->logicalOperatorRegistry = $logicalOperatorRegistry;
        return $this;
    }

    /**
     * @return SpecificationInterface
     */
    public function getSpecification(): SpecificationInterface
    {
        return $this->specification;
    }

    /**
     * Builds the specification using the request HTTP options.
     *
     * @param array $criteria
     * @throws CriteriaException
     * @throws InvalidCustomTypeException
     * @return Criteria
     */
    public function init(array $criteria): Criteria
    {
        $this->specification = $this->resolveCriteria($criteria);
        return $this;
    }

    /**
     * Resolves the criteria passed by request into aggregation of logical operations of criteria objects.
     * This aggregation will be a specification.
     *
     * @param array $criteria
     * @return SpecificationInterface
     * @throws InvalidCustomTypeException
     * @throws CriteriaException
     */
    public function resolveCriteria(array $criteria): SpecificationInterface
    {
        // If we detect the name of the field that manages a Leaf criterion...
        if (\array_key_exists('operator', $criteria)) {
            return $this->buildLeafFromCriterion(new Criterion($criteria));
        }
        // If we detect the name of any logical operator that make us build a branch...
        if (!empty(\array_intersect_key($this->logicalOperatorRegistry->getOperators(), $criteria))) {
            return $this->buildBranchFromCriteria($criteria);
        }

        // Throw exception if we did not found what was expected.
        throw CriteriaException::invalidCriteriaFormat(\key($criteria));
    }

    /**
     * {@inheritdoc}
     */
    public function buildLeafFromCriterion(Criterion $criterion): AbstractLeafSpecification
    {
        return $this->operatorRegistry->buildOperator($criterion);
    }

    /**
     * {@inheritdoc}
     */
    public function buildBranchFromCriteria(array $criteria): AbstractBranchSpecification
    {
        return $this->logicalOperatorRegistry->buildLogicalOperator($criteria, $this);
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }
}
