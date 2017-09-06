<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query\QueryRequestInterface;

/**
 * Abstract Class AbstractGetByIdsQueryAdapter
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Adapter\Generalisation
 * @abstract
 */
abstract class AbstractGetByIdsQueryAdapter
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
        $parameters = $request->getRequestParameters();
        $entityIds = \explode(',', $parameters['entityIds']);

        return new $this->queryNamespace($entityIds);
    }
}
