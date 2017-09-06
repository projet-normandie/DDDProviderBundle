<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query\Handler;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\TypeHinting\TraitStdClass;

/**
 * Abstract Class AbstractQueryHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Query\Handler
 * @abstract
 */
abstract class AbstractQueryHandler implements QueryHandlerInterface
{
    use TraitStdClass;

    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function process(QueryInterface $query)
    {
        return $this->manager->process(self::buildFromObject($query));
    }
}
