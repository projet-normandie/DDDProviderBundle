<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation\ObservableWorkflowHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Workflow\Generalisation\TraitElementPointer;

/**
 * Abstract Class AbstractObserver
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Observer
 * @abstract
 */
abstract class AbstractObserver implements ObserverInterface
{
    use TraitElementPointer;

    /**
     * @var CommandInterface
     */
    protected $wfCommand;

    /**
     * @var \stdClass
     */
    protected $wfData;

    /**
     * @var \stdClass
     */
    protected $wfLastData;

    /**
     * @param ObservableInterface $wfHandler
     * @return ObserverInterface
     */
    public function notify(ObservableInterface $wfHandler): ObserverInterface
    {
        return $this->init($wfHandler)->update()->addHistory();
    }

    /**
     * @param ObservableWorkflowHandlerInterface $wfHandler
     * @return AbstractObserver
     */
    protected function init(ObservableWorkflowHandlerInterface $wfHandler): AbstractObserver
    {
        $this->wfCommand = $wfHandler->getCommand();
        $this->wfData = $wfHandler->getData();
        $this->wfLastData = new \stdClass();

        foreach ($this->wfData as $propertyName => $aAllSteps) {
            $this->wfLastData->{$propertyName} = self::getLastElement($aAllSteps);
        }
        return $this;
    }

    /**
     * @return AbstractObserver
     */
    abstract protected function update(): AbstractObserver;

    /**
     * @return ObserverInterface
     */
    protected function addHistory(): ObserverInterface
    {
        foreach ($this->wfLastData as $propertyName => $propertyValue) {
            $this->wfData->{$propertyName}[] = $propertyValue;
        }

        return $this;
    }
}
