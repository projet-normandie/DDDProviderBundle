<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class InhibitionSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class InhibitionSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'inhibition';

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

        // The INH (inhibition) operator is "a AND (NOT b)".
        [$a, $b] = $renderedSpecs;
        return '( ( ' . $a . ' ) AND ( NOT ( ' . $b . ' ) ) )';
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
