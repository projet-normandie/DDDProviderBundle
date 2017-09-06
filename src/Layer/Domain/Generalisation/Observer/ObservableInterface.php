<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer;

/**
 * Interface ObservableInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Observer
 */
interface ObservableInterface
{
    /**
     * Adds a new Observer we will need to notify next.
     *
     * @param ObserverInterface $observer
     * @return ObservableInterface
     */
    public function addObserver(ObserverInterface $observer): ObservableInterface;

    /**
     * Notifies all Observer objects that were added to the Observable object.
     */
    public function notifyObservers(): void;
}
