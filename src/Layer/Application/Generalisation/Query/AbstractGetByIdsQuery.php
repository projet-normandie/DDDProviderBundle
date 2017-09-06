<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;

/**
 * Abstract Class AbstractGetByIdsQuery.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Query
 * @abstract
 */
abstract class AbstractGetByIdsQuery implements QueryInterface
{
    /**
     * @var array
     */
    protected $entityIds;

    /**
     * AbstractGetByIdsQuery constructor.
     *
     * @param array $entityIds
     */
    public function __construct(array $entityIds)
    {
        $this->entityIds = $entityIds;
    }

    /**
     * @return array
     */
    public function getEntityIds(): array
    {
        return $this->entityIds;
    }

    /**
     * @param array $entityIds
     * @return $this
     */
    public function setEntityIds(array $entityIds)
    {
        $this->entityIds = $entityIds;
        return $this;
    }
}
