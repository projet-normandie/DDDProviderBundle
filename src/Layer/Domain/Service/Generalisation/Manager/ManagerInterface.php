<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager;

use stdClass;

/**
 * Interface ManagerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager
 */
interface ManagerInterface
{
    /**
     * @param stdClass $object
     * @return mixed
     */
    public function process(stdClass $object);
}
