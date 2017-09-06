<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Observer;

/**
 * Interface ObserverInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Observer
 */
interface ObserverInterface
{
    /**
     * @param ObservableInterface $wfHandler
     * @return ObserverInterface
     */
    public function notify(ObservableInterface $wfHandler): ObserverInterface;
}
