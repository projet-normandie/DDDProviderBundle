<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

use Nicodev\Asserts\TraitAssertComparison;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Application\Specification\SpecNumberException;

/**
 * Trait TraitCheckBranch
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 */
trait TraitCheckBranch
{
    use TraitAssertComparison;

    /**
     * Checks the number specification is at least the expected number depending on the operator.
     *
     * @return AbstractBranchSpecification
     */
    protected function checkMinSpecifications(): AbstractBranchSpecification
    {
        $nbSpecs = \count($this->specifications);
        $e = SpecNumberException::notEnough(static::IDENTIFIER, static::EXPECTED_MIN_SPECIFICATIONS, $nbSpecs);
        static::assertGreaterThan($nbSpecs, static::EXPECTED_MIN_SPECIFICATIONS, $e);

        return $this;
    }

    /**
     * Checks the number specification is at most the expected number depending on the operator.
     *
     * @return AbstractBranchSpecification
     */
    protected function checkMaxSpecifications(): AbstractBranchSpecification
    {
        $nbSpecs = \count($this->specifications);
        $e = SpecNumberException::tooMany(static::IDENTIFIER, static::EXPECTED_MAX_SPECIFICATIONS, $nbSpecs);
        static::assertLessThan($nbSpecs, static::EXPECTED_MAX_SPECIFICATIONS, $e);

        return $this;
    }

    /**
     * Checks the number specification is exactly the expected number depending on the operator.
     *
     * @return AbstractBranchSpecification
     */
    protected function checkNbSpecifications(): AbstractBranchSpecification
    {
        $nbSpecs = \count($this->specifications);
        $e = SpecNumberException::invalidNumber(static::IDENTIFIER, static::EXPECTED_SPECIFICATIONS, $nbSpecs);
        static::assertStrictEquals($nbSpecs, static::EXPECTED_SPECIFICATIONS, $e);

        return $this;
    }
}
