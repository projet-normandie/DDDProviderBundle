<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity;

/**
 * Interface TraitSimpleInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Entity
 */
interface TraitSimpleInterface
{
    /**
     * Set archived
     *
     * @param bool $archived
     */
    public function setArchived(bool $archived): void;

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived(): bool;
}
