<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity;

/**
 * Interface TraitPositionInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Entity
 */
interface TraitPositionInterface
{
    /**
     * Set $position
     *
     * @param integer $position
     */
    public function setPosition(int $position): void;

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition(): int;
}
