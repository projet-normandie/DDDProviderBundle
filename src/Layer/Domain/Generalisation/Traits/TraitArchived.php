<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TraitArchived
 * Trait for default attributes.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Traits
 */
trait TraitArchived
{
    /**
     * @var boolean $archived
     *
     * @ORM\Column(name="archived", type="boolean", nullable=true)
     */
    protected $archived = false;

    /**
     * @param bool $archived
     * @return $this
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;
        return $this;
    }

    /**
     * @return bool
     */
    public function getArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }
}
