<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Handlers;

/**
 * Interface SpecificationHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Handlers
 */
interface SpecificationHandlerInterface
{
    /**
     * @return string
     */
    public function renderSpecification(): string;
}
