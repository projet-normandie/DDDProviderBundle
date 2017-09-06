<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CreateOneCommandInterface;

/**
 * Abstract Class AbstractCreateOneCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractCreateOneCommand extends AbstractCommand implements CreateOneCommandInterface
{
}
