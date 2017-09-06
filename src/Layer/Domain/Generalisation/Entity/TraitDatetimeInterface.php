<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity;

use DateTime;

/**
 * Interface TraitDatetimeInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Generalisation\Entity
 */
interface TraitDatetimeInterface
{
    /**
     * Set created_at
     *
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt): void;

    /**
     * Get created_at
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime;

    /**
     * Set updated_at
     *
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt): void;

    /**
     * Get updated_at
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime;

    /**
     * Set published_at
     *
     * @param DateTime $publishedAt
     */
    public function setPublishedAt($publishedAt): void;

    /**
     * Get published_at
     *
     * @return DateTime
     */
    public function getPublishedAt(): DateTime;

    /**
     * Set archive_at
     *
     * @param DateTime $archiveAt
     */
    public function setArchiveAt($archiveAt): void;

    /**
     * Get archive_at
     *
     * @return DateTime
     */
    public function getArchiveAt(): DateTime;
}
