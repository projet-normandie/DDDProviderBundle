<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Handlers;

/**
 * Class OrmSpecificationHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Handlers
 */
class OrmSpecificationHandler extends AbstractSpecificationHandler
{
    /**
     * {@inheritdoc}
     */
    public function renderSpecification(): string
    {
        return $this->specification->renderOrm();
    }
}
