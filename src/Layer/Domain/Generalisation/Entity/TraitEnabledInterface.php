<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity;

/**
 * Interface TraitEnabledInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Entity
 */
interface TraitEnabledInterface
{
    /**
     * Set enabled
     *
     * @param bool $boolean
     */
    public function setEnabled(bool $boolean): void;

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool;
}
