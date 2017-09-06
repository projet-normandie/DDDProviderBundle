<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class ImplicatesSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class ImplicatesSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'implicates';

    /** @var int Exact number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_SPECIFICATIONS = 2;

    /**
     * ImplicatesSpec constructor.
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
            $renderedSpecs[] = ' (' . $specification->renderOrm() . ') ';
        }

        // The → (implicates) operator is "(NOT a) OR b".
        [$a, $b] = $renderedSpecs;
        return ' ( ( NOT ( ' . $a . ' ) ) OR ' . $b . ' ) ';
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
