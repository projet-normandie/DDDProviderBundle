<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation;

use ReflectionObject;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer\ObservableInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer\ObserverInterface;
use stdClass;

/**
 * Abstract Class AbstractWFHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Workflow\Generalisation
 * @abstract
 */
abstract class AbstractWFHandler implements ObservableWorkflowHandlerInterface
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @var ObserverInterface[]
     */
    protected $observers;

    /**
     * @var string
     */
    protected $kernelEnvironment;

    /**
     * @var stdClass
     */
    public $data;

    /**
     * AbstractWFHandler constructor.
     * @param string $kernelEnvironment
     */
    public function __construct(string $kernelEnvironment)
    {
        $this->observers = [];
        $this->data = new stdClass();
        $this->kernelEnvironment = $kernelEnvironment;
    }

    /**
     * @param CommandInterface $command
     */
    public function process(CommandInterface $command): void
    {
        $this->initCommand($command);

        // notify all observers
        $this->notifyObservers();
    }

    /**
     * @param ObserverInterface $observer
     * @param string[]|string|null $allowedEnvironments List of allowed environments where the given observer will be
     *                                                  added. If NULL, allows all observers.
     * @return ObservableInterface
     */
    public function addObserver(ObserverInterface $observer, $allowedEnvironments = null): ObservableInterface
    {
        if (null === $allowedEnvironments || \in_array($this->kernelEnvironment, (array)$allowedEnvironments, true)) {
            $this->observers[] = $observer;
        }

        return $this;
    }

    /**
     * This method calls notify() method on all observers
     */
    public function notifyObservers(): void
    {
        \array_walk($this->observers, function (ObserverInterface $observer) {
            $observer->notify($this);
        });
    }

    /**
     * @return CommandInterface
     */
    public function getCommand(): CommandInterface
    {
        return $this->command;
    }

    /**
     * @param CommandInterface $command
     */
    protected function initCommand(CommandInterface $command): void
    {
        $this->command = $command;
        foreach ((new ReflectionObject($command))->getProperties() as $oProperty) {
            $oProperty->setAccessible(true);
            $this->data->{$oProperty->getName()} = [$oProperty->getValue($this->command)];
        }
    }

    /**
     * @return stdClass
     */
    public function getData(): stdClass
    {
        return $this->data;
    }
}
