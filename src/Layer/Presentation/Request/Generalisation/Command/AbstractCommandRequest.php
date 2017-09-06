<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\AbstractRequest;

/**
 * Abstract Class AbstractCommandRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Command
 * @abstract
 */
abstract class AbstractCommandRequest extends AbstractRequest implements CommandRequestInterface
{
}
