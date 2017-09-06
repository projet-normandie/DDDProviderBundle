<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

/**
 * Abstract Class AbstractSpecification
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 * @abstract
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    use TraitParameters;
    use TraitReplacements;

    /** @var string Unique identifier name of the operator. Overloaded for each operators. */
    /*public*/ const IDENTIFIER = '';
}
