<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TraitEnabled
 * Trait for enabled attributes.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Traits
 */
trait TraitEnabled
{
    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled;

    /**
     * @param bool $boolean
     * @return $this
     */
    public function setEnabled(bool $boolean)
    {
        $this->enabled = $boolean;
        return $this;
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }
}
