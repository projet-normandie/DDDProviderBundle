<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor;

/**
 * Interface ProcessInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Processor
 */
interface ProcessInterface
{
    /**
     * @param mixed $object
     * @return void
     */
    public function update($object): void;
}
