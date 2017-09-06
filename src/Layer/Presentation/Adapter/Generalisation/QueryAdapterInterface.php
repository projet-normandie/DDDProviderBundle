<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query\QueryRequestInterface;

/**
 * Interface QueryAdapterInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Adapter\Generalisation
 */
interface QueryAdapterInterface
{
    /**
     * @param QueryRequestInterface $request
     * @return QueryInterface
     */
    public function buildQueryFromRequest(QueryRequestInterface $request): QueryInterface;
}
