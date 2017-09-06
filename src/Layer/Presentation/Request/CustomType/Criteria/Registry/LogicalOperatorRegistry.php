<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Registry;

use Nicodev\Asserts\TraitAssertArray;
use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{Logical, SpecificationInterface};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Presentation\CriteriaException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Criterion;

/**
 * Class LogicalOperatorRegistry
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Criteria\Registry
 */
class LogicalOperatorRegistry extends AbstractOperatorRegistry
{
    use TraitAssertArray;

    /**
     * @var string[] Mapping field that must define the expected logical operator as "key" and the related class to
     *               build as "value". Logical operators allows building of Branch specifications.
     */
    protected $operators = [
        Logical\OrSpec::IDENTIFIER => Logical\OrSpec::class,
        Logical\AndSpec::IDENTIFIER => Logical\AndSpec::class,
        Logical\NotSpec::IDENTIFIER => Logical\NotSpec::class,
        Logical\ImplicatesSpec::IDENTIFIER => Logical\ImplicatesSpec::class,
        Logical\InhibitionSpec::IDENTIFIER => Logical\InhibitionSpec::class,
        Logical\XorSpec::IDENTIFIER => Logical\XorSpec::class,
        Logical\EquatesSpec::IDENTIFIER => Logical\EquatesSpec::class,
    ];

    /**
     * Automatically throws an exception because it is not a possible behavior to access to this method with this class.
     *
     * @param Criterion $criterion
     * @return SpecificationInterface
     * @throws CriteriaException
     */
    public function buildOperator(Criterion $criterion): SpecificationInterface
    {
        throw CriteriaException::invalidCriteriaFormat($criterion->getOperator());
    }

    /**
     * Tries to build the given operator specification, if defined.
     *
     * @param array $requestCriteria The raw criteria from the request.
     * @param Criteria $criteria The criteria object that knows the business to how resolve the given criteria.
     * @return SpecificationInterface
     */
    public function buildLogicalOperator(array $requestCriteria, Criteria $criteria): SpecificationInterface
    {
        $key = \key($requestCriteria);
        $exception = CriteriaException::invalidCriteriaLogicalOperator($key, \array_keys($this->getOperators()));
        $logicalOperatorSpec = static::assertKeyExists($this->getOperators(), $key, $exception);

        $criterionList = \array_map([$criteria, 'resolveCriteria'], $requestCriteria[$key]);
        return new $logicalOperatorSpec(...$criterionList);
    }
}
