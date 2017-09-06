<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\PatchOneCommandInterface;

/**
 * Abstract Class AbstractPatchOneCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractPatchOneCommand extends AbstractCommand implements PatchOneCommandInterface
{
}
