<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface UpdateOneCommandInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface UpdateOneCommandInterface
{
    /**
     * @return int|string
     */
    public function getEntityId();
}
