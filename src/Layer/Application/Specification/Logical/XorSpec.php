<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class XorSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class XorSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'xor';

    /** @var int Exact number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_SPECIFICATIONS = 2;

    /**
     * XorSpec constructor.
     *
     * @param SpecificationInterface[] $specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        parent::__construct(...$specifications);
        $this->checkNbSpecifications();
    }
    /**
     * {@inheritdoc}
     */
    public function renderOrm(): string
    {
        $renderedSpecs = [];
        foreach ($this->getSpecifications() as $specification) {
            $renderedSpecs[] = $specification->renderOrm();
        }

        // The XOR operator is "(a AND !b) OR (!a AND b)".
        [$a, $b] = $renderedSpecs;
        return ' ( ' . $a . ' AND ( NOT ( ' . $b . ' ) ) ) OR ( ( NOT ( ' . $a . ' ) ) AND ' . $b . ' ) ';
    }

    /**
     * {@inheritdoc}
     */
    public function renderOdm(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function renderCouchDB(): string
    {
        return '';
    }
}
