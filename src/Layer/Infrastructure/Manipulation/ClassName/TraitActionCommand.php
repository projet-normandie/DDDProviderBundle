<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\ClassName;

/**
 * Trait TraitActionCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Manipulation\ClassName
 */
trait TraitActionCommand
{
    /**
     * Returns the lowercase action from the Command full namespace.
     * The action is the meaning of the Command.
     * Ex: CreateCommand => create
     *
     * @param string $commandNS The namespace of the command.
     * @return string
     */
    public function getActionFromCommand(string $commandNS): string
    {
        return \strtolower(\str_replace('Command', '', \substr($commandNS, \strrpos($commandNS, '\\') + 1)));
    }
}
