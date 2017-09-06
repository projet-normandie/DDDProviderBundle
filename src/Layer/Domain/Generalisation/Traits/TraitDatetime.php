<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Trait TraitDatetime
 * Trait for time attributes.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Traits
 */
trait TraitDatetime
{
    /**
     * @var Datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var DateTime $publishedAt
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * @var DateTime $archiveAt
     *
     * @ORM\Column(name="archive_at", type="datetime", nullable=true)
     */
    protected $archiveAt;

    /**
     * @ORM\PrePersist()
     *
     * @return $this
     */
    public function setCreatedValue()
    {
        // we create the Created_at value
        if (!$this->getCreatedAt()) {
            $this->setCreatedAt(new DateTime());
        }
        // we modify the Updated_at value
        if (!$this->getUpdatedAt()) {
            $this->setUpdatedAt(new DateTime());
        }
        return $this;
    }

    /**
     * @ORM\PreUpdate()
     *
     * @return $this
     */
    public function setUpdatedValue()
    {
        $this->setUpdatedAt(new DateTime());
        return $this;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param $publishedAt
     * @return $this
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @param $archiveAt
     * @return $this
     */
    public function setArchiveAt($archiveAt)
    {
        $this->archiveAt = $archiveAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getArchiveAt(): DateTime
    {
        return $this->archiveAt;
    }
}
