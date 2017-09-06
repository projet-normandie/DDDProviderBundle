<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor;

/**
 * Interface ProcessorInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Processor
 */
interface ProcessorInterface
{
    /**
     * @param string $key
     * @param ProcessInterface $process
     * @return ProcessorInterface
     */
    public function addProcess(string $key, ProcessInterface $process): ProcessorInterface;

    /**
     * @param string $key
     * @param mixed $object
     * @return void
     */
    public function executeProcess(string $key, $object): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasProcess(string $key): bool;

    /**
     * @param string $key
     * @return void
     */
    public function removeProcess(string $key): void;
}
