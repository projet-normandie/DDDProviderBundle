<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface PatchOneCommandInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface PatchOneCommandInterface
{
    /**
     * @return int|string
     */
    public function getEntityId();
}
