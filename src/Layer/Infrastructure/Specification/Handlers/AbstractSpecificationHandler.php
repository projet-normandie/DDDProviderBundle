<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Handlers;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;

/**
 * Abstract Class AbstractSpecificationHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Handlers
 * @abstract
 */
abstract class AbstractSpecificationHandler implements SpecificationHandlerInterface
{
    /**
     * @var SpecificationInterface
     */
    protected $specification;

    /**
     * AbstractCriteria constructor.
     * @param SpecificationInterface $specification
     */
    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @return SpecificationInterface
     */
    public function getSpecification(): SpecificationInterface
    {
        return $this->specification;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function renderSpecification(): string;
}
