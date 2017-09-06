<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface CommandValidationHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface CommandValidationHandlerInterface
{
    /**
     * @var CommandInterface $command
     * @return bool
     */
    public function process(CommandInterface $command): bool;
}
