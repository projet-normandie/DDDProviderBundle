<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class OrSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class OrSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'or';

    /** @var int Maximum number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_MAX_SPECIFICATIONS = 2;

    /**
     * OrSpec constructor.
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
        return ' (' . \implode(' OR ', $renderedSpecifications) . ') ';
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
