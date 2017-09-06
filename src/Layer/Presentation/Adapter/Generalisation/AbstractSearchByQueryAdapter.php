<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query\QueryRequestInterface;

/**
 * Abstract Class AbstractSearchByQueryAdapter
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Adapter\Generalisation
 * @abstract
 */
abstract class AbstractSearchByQueryAdapter
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
        ['criteria' => $criteria, 'limit' => $limit, 'orderBy' => $orderBy] = $request->getRequestParameters();
        return new $this->queryNamespace($criteria, $limit, $orderBy);
    }
}
