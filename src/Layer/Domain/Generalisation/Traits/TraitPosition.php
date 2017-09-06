<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TraitPosition
 * Trait for position attributes.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Traits
 */
trait TraitPosition
{
    /**
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;

    /**
     * @param integer $position
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
