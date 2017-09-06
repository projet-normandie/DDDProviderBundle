<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Coordination\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation\QueryAdapterInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query\QueryRequestInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\ResponseHandlerInterface;

/**
 * Trait TraitSearchByController
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Coordination\Generalisation\Query
 */
trait TraitSearchByController
{
    /**
     * @var QueryAdapterInterface Adapter that will create the query from the request.
     */
    protected $queryAdapter;

    /**
     * @var QueryRequestInterface Request object that is resolved from the request.
     */
    protected $queryRequest;

    /**
     * @var QueryHandlerInterface Processes the business work.
     */
    protected $queryHandler;

    /**
     * @var ResponseHandlerInterface Formatter of the response.
     */
    protected $responseHandler;

    /**
     * Base of GetOneController constructors.
     *
     * @param QueryAdapterInterface $queryAdapter
     * @param QueryRequestInterface $queryRequest
     * @param QueryHandlerInterface $queryHandler
     * @param ResponseHandlerInterface $responseHandler
     */
    public function __construct(
        QueryAdapterInterface $queryAdapter,
        QueryRequestInterface $queryRequest,
        QueryHandlerInterface $queryHandler,
        ResponseHandlerInterface $responseHandler
    ) {
        $this->queryAdapter = $queryAdapter;
        $this->queryRequest = $queryRequest;
        $this->queryHandler = $queryHandler;
        $this->responseHandler = $responseHandler;
    }
}
