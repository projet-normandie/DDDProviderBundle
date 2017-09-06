<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification\Logical;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\{
    AbstractBranchSpecification, SpecificationInterface
};

/**
 * Class NotSpec
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specifications\Logical
 */
class NotSpec extends AbstractBranchSpecification
{
    /** @var string Unique identifier name of the operator. */
    /*public*/ const IDENTIFIER = 'not';

    /** @var int Exact number of specifications the logical operator must aggregate. */
    /*protected*/ const EXPECTED_SPECIFICATIONS = 1;

    /**
     * NotSpec constructor.
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
        return ' (NOT (' . \reset($this->specifications)->renderOrm() . ' )) ';
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
