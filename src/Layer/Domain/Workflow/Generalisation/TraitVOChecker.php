<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Workflow\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Logger\Generalisation\TraitLogger;

/**
 * Trait TraitVOChecker.
 * This trait provides methods that check VOs on a workflow process.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Workflow\Generalisation
 */
trait TraitVOChecker
{
    use TraitLogger;

    /**
     * Check that all value objects sent are not null, otherwise, throw the given exception.
     *
     * @param array $aVOs
     * @param \Exception $exception
     * @throws \Exception
     */
    protected function checkVO(array $aVOs, \Exception $exception): void
    {
        if (\count($aVOs) !== \count(\array_filter($aVOs))) {
            $this->logger->error($exception->getMessage());
            throw $exception;
        }
    }
}
