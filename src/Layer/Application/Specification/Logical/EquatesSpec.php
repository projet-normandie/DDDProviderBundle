<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class EquatesSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class EquatesSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'equates';

    /** @var int Exact number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_SPECIFICATIONS = 2;

    /**
     * EquatesSpec constructor.
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

        // The ≡ (equates) operator is "NOT( XOR )" so, "NOT( (a AND !b) OR (!a AND b) )".
        [$a, $b] = $renderedSpecs;
        return ' (NOT( ( ' . $a . ' AND ( NOT ( ' . $b . ' ) ) ) OR ( ( NOT ( ' . $a . ' ) ) AND ' . $b . ' ) )) ';
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
