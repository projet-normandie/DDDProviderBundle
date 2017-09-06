<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface CommandHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function process(CommandInterface $command);
}
