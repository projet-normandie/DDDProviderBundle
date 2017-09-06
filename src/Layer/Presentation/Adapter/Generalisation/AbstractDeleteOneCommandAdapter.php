<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Adapter\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command\CommandRequestInterface;

/**
 * Abstract Class AbstractDeleteOneCommandAdapter
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Adapter\Generalisation
 * @abstract
 */
abstract class AbstractDeleteOneCommandAdapter
{
    /**
     * @var string
     */
    protected $commandNamespace;

    /**
     * @param CommandRequestInterface $request
     * @return CommandInterface
     */
    public function buildCommandFromRequest(CommandRequestInterface $request): CommandInterface
    {
        $parameters = $request->getRequestParameters();
        $entityId = $parameters['entityId'];
        $rev = $parameters['revision'];

        return new $this->commandNamespace($entityId, $rev);
    }
}
