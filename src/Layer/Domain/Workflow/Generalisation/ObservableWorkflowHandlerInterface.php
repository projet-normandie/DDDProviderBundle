<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer\ObservableInterface;

/**
 * Interface ObservableWorkflowHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Workflow\Generalisation
 */
interface ObservableWorkflowHandlerInterface extends WorkflowHandlerInterface, ObservableInterface
{
}
