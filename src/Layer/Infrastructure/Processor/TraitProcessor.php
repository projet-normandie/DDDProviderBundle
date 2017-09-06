<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Processor;

/**
 * Trait TraitProcessor
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Processor
 */
trait TraitProcessor
{
    /**
     * @var array[]
     */
    protected $process = [];

    /**
     * @param string $key
     * @param ProcessInterface $process
     * @return ProcessorInterface
     */
    public function addProcess(string $key, ProcessInterface $process): ProcessorInterface
    {
        $this->process[$key][] = $process;
        return $this;
    }

    /**
     * @param string $key
     * @param ProcessInterface[] $processes
     * @return ProcessorInterface
     */
    public function addProcesses(string $key, array $processes): ProcessorInterface
    {
        $this->process[$key] = $processes;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $object
     * @return void
     */
    public function executeProcess(string $key, $object): void
    {
        if ($this->hasProcess($key)) {
            /** @var ProcessInterface $process */
            foreach ($this->process[$key] as $process) {
                $process->update($object);
            }
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasProcess(string $key): bool
    {
        return \array_key_exists($key, $this->process);
    }

    /**
     * @param string $key
     * @return void
     */
    public function removeProcess(string $key): void
    {
        unset($this->process[$key]);
    }
}
