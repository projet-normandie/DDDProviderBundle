<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\UpdateOneCommandInterface;

/**
 * Abstract Class AbstractUpdateOneCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractUpdateOneCommand extends AbstractCommand implements UpdateOneCommandInterface
{
}
