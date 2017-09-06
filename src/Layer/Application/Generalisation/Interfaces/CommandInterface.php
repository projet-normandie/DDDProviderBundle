<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface CommandInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface CommandInterface
{
    /**
     * @param bool $skipNull
     * @return mixed
     */
    public function toArray(bool $skipNull = false): array;
}
