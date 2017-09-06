<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query\QueryRequestInterface;

/**
 * Abstract Class AbstractGetAllQueryAdapter
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Adapter\Generalisation
 * @abstract
 */
abstract class AbstractGetAllQueryAdapter
{
    /**
     * @var string
     */
    protected $queryNamespace;

    /**
     * @param QueryRequestInterface $request
     * @return QueryInterface
     */
    public function buildQueryFromRequest(QueryRequestInterface $request): QueryInterface
    {
        ['limit' => $limit] = $request->getRequestParameters();
        return new $this->queryNamespace($limit);
    }
}
