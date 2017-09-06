<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class AndSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class AndSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'and';

    /** @var int Minimum number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_MIN_SPECIFICATIONS = 2;

    /**
     * AndSpec constructor.
     *
     * @param SpecificationInterface[] $specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        parent::__construct(...$specifications);
        $this->checkMinSpecifications();
    }

    /**
     * {@inheritdoc}
     */
    public function renderOrm(): string
    {
        $renderedSpecifications = [];
        foreach ($this->getSpecifications() as $specification) {
            $renderedSpecifications[] = ' (' . $specification->renderOrm() . ') ';
        }
        return ' (' . \implode(' AND ', $renderedSpecifications) . ') ';
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
