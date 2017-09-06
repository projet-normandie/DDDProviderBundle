<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

/**
 * Abstract Class AbstractDeleteOneCommand.
 *
 * @category   ProjetNormandie\DddProviderBundle\Layer
 * @package    Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractDeleteOneCommand extends AbstractCommand
{
    /**
     * @var int|string
     */
    protected $entityId;

    /**
     * @var string
     */
    protected $revision;

    /**
     * AbstractDeleteOneCommand constructor.
     *
     * @param string|int $entityId
     * @param string|null $revision
     */
    public function __construct($entityId, string $revision = null)
    {
        $this->entityId = $entityId;
        $this->revision = $revision;
    }

    /**
     * @return int|string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return string
     */
    public function getRevision(): string
    {
        return $this->revision;
    }
}
