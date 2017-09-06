<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification\SpecNumberException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\CriteriaRepositoryInterface;

/**
 * Abstract Class AbstractBranchSpecification
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 * @abstract
 */
abstract class AbstractBranchSpecification extends AbstractSpecification
{
    use TraitCheckBranch;

    /**
     * @var int Exact number of specifications the logical operator must aggregate.
     *          Must be overload in each operator if needed.
     */
    /*protected*/ const EXPECTED_SPECIFICATIONS = 1;

    /**
     * @var int Minimum number of specifications the logical operator must aggregate.
     *          Must be overload in each operator if needed.
     */
    /*protected*/ const EXPECTED_MIN_SPECIFICATIONS = 1;

    /**
     * @var int Maximum number of specifications the logical operator must aggregate.
     *          Must be overload in each operator if needed.
     */
    /*protected*/ const EXPECTED_MAX_SPECIFICATIONS = 1;

    /**
     * @var SpecificationInterface[]
     */
    protected $specifications = [];

    /**
     * AbstractBranchSpecification constructor.
     * @param SpecificationInterface[] $specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * @return SpecificationInterface[]
     */
    public function getSpecifications(): array
    {
        return $this->specifications;
    }

    /**
     * {@inheritdoc}
     */
    public function manageSpecificationForManager(CriteriaManagerInterface $manager): SpecificationInterface
    {
        \array_map([$manager, 'manageSpecification'], $this->getSpecifications());
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function manageSpecificationForRepository(CriteriaRepositoryInterface $repository): SpecificationInterface
    {
        \array_map([$repository, 'manageSpecification'], $this->getSpecifications());
        return $this;
    }

    /**
     * Prepares the exception that must be thrown if the field parameter is invalid for the current operator.
     *
     * @param int $expected
     * @return SpecNumberException
     */
    protected function prepareNotEnoughException(int $expected): SpecNumberException
    {
        return SpecNumberException::notEnough(static::IDENTIFIER, $expected, \count($this->specifications));
    }

    /**
     * Prepares the exception that must be thrown if the value parameter is invalid for the current operator.
     *
     * @param int $expected
     * @return SpecNumberException
     */
    protected function prepareInvalidNumberException(int $expected): SpecNumberException
    {
        return SpecNumberException::invalidNumber(static::IDENTIFIER, $expected, \count($this->specifications));
    }
}
