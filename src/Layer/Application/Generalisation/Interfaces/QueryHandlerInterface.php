<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces;

/**
 * Interface QueryHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Interfaces
 */
interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function process(QueryInterface $query);
}
