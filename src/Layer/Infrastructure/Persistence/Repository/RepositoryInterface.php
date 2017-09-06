<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor\ProcessorInterface;

/**
 * Interface RepositoryInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository
 */
interface RepositoryInterface
{
    /**
     * @param \stdClass $object
     *
     * @return mixed
     */
    public function execute(\stdClass $object);

    /**
     * @param string $key
     * @param ProcessInterface $process
     * @return ProcessorInterface
     */
    public function addProcess(string $key, ProcessInterface $process): ProcessorInterface;

    /**
     * @param string $key
     * @param ProcessInterface[] $processes
     * @return ProcessorInterface
     */
    public function addProcesses(string $key, array $processes): ProcessorInterface;
}
