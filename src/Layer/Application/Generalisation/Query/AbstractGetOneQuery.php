<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;

/**
 * Abstract Class AbstractGetOneQuery.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Query
 * @abstract
 */
abstract class AbstractGetOneQuery implements QueryInterface
{
    /**
     * @var int|string $entityId
     */
    protected $entityId;

    /**
     * @param int|string $entityId
     */
    public function __construct($entityId)
    {
        $this->entityId = $entityId;
    }
    /**
     * @return int|string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param int|string $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
        return $this;
    }
}
