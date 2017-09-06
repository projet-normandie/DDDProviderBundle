<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Registry;

use Nicodev\Asserts\TraitAssertArray;
use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{Comparison, Distance, SpecificationInterface};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Presentation\CriteriaException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Criterion;

/**
 * Class OperatorRegistry
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Criteria\Registry
 */
class OperatorRegistry extends AbstractOperatorRegistry
{
    use TraitAssertArray;

    /** @var string[] List of all operators available. */
    protected $operators = [
        Comparison\EqualsToSpec::IDENTIFIER => Comparison\EqualsToSpec::class,
        Comparison\GreaterThanSpec::IDENTIFIER => Comparison\GreaterThanSpec::class,
        Comparison\GreaterThanOrEqualsToSpec::IDENTIFIER => Comparison\GreaterThanOrEqualsToSpec::class,
        Comparison\LessThanSpec::IDENTIFIER => Comparison\LessThanSpec::class,
        Comparison\LessThanOrEqualsToSpec::IDENTIFIER => Comparison\LessThanOrEqualsToSpec::class,
        Comparison\DifferentFromSpec::IDENTIFIER => Comparison\DifferentFromSpec::class,
        Comparison\LikeSpec::IDENTIFIER => Comparison\LikeSpec::class,
        Comparison\NotLikeSpec::IDENTIFIER => Comparison\NotLikeSpec::class,
        Comparison\IsNullSpec::IDENTIFIER => Comparison\IsNullSpec::class,
        Comparison\IsNotNullSpec::IDENTIFIER => Comparison\IsNotNullSpec::class,
        Comparison\InSpec::IDENTIFIER => Comparison\InSpec::class,
        Comparison\NotInSpec::IDENTIFIER => Comparison\NotInSpec::class,
        Comparison\BetweenSpec::IDENTIFIER => Comparison\BetweenSpec::class,
        Comparison\NotBetweenSpec::IDENTIFIER => Comparison\NotBetweenSpec::class,

        Distance\PlaneDistanceSpec::IDENTIFIER => Distance\PlaneDistanceSpec::class,
        Distance\SpaceDistanceSpec::IDENTIFIER => Distance\SpaceDistanceSpec::class,
    ];

    /**
     * Tries to build the given operator specification, if defined.
     *
     * @param Criterion $criterion
     * @return SpecificationInterface
     */
    public function buildOperator(Criterion $criterion): SpecificationInterface
    {
        $e = CriteriaException::invalidCriteriaOperator($criterion->getOperator(), \array_keys($this->getOperators()));
        $className = static::assertKeyExists($this->getOperators(), $criterion->getOperator(), $e);
        return new $className($criterion->getField(), $criterion->getValue());
    }

    /**
     * Automatically throws an exception because it is not a possible behavior to access to this method with this class.
     *
     * @param array $requestCriteria
     * @param Criteria $criteria
     * @return SpecificationInterface
     * @throws CriteriaException
     */
    public function buildLogicalOperator(array $requestCriteria, Criteria $criteria): SpecificationInterface
    {
        throw CriteriaException::invalidCriteriaFormat(\key($requestCriteria));
    }
}
