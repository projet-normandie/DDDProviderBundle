<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation;

/**
 * Interface QueryInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Generalisation
 */
interface QueryInterface
{
    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @return mixed
     */
    public function getResults();

    /**
     * @return int
     */
    public function getTotalCount(): int;
}
