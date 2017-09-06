<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;

/**
 * Trait TraitManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Workflow\Generalisation
 */
trait TraitManager
{
    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     * @return $this
     */
    public function setManager(ManagerInterface $manager)
    {
        $this->manager = $manager;
        return $this;
    }
}
