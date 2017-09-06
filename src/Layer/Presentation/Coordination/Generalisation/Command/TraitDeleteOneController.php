<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Coordination\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation\CommandAdapterInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command\CommandRequestInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\ResponseHandlerInterface;

/**
 * Trait TraitDeleteOneController
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Coordination\Generalisation\Command
 */
trait TraitDeleteOneController
{
    /**
     * @var CommandAdapterInterface Adapter that will create the command from the request.
     */
    protected $commandAdapter;

    /**
     * @var CommandRequestInterface Request object that is resolved from the request.
     */
    protected $commandRequest;

    /**
     * @var CommandHandlerInterface Processes the business work.
     */
    protected $commandHandler;

    /**
     * @var ResponseHandlerInterface Formatter of the response.
     */
    protected $responseHandler;

    /**
     * Base of DeleteOneController constructors.
     *
     * @param CommandAdapterInterface $commandAdapter
     * @param CommandRequestInterface $commandRequest
     * @param CommandHandlerInterface $commandHandler
     * @param ResponseHandlerInterface $responseHandler
     */
    public function __construct(
        CommandAdapterInterface $commandAdapter,
        CommandRequestInterface $commandRequest,
        CommandHandlerInterface $commandHandler,
        ResponseHandlerInterface $responseHandler
    ) {
        $this->commandAdapter = $commandAdapter;
        $this->commandRequest = $commandRequest;
        $this->commandHandler = $commandHandler;
        $this->responseHandler = $responseHandler;
    }
}
