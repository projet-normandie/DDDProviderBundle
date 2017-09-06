<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Query;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory\RepositoryFactoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\CriteriaManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\{DomainException, InvalidArgumentException};
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\{Criteria, OrderBy};
use stdClass;

/**
 * Class SearchByManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Query
 */
class SearchByManager extends AbstractQueryManager implements CriteriaManagerInterface
{
    /**
     * @param stdClass $object
     * @return array|EntityInterface[]
     * @throws InvalidArgumentException
     * @throws DomainException
     */
    public function process(stdClass $object): array
    {
        $this->criteriaManager($object->criteria)->orderByManager($object->orderBy);

        return $this->factory->buildRepository(RepositoryFactoryInterface::SEARCH_BY_REPOSITORY)->execute($object);
    }

    /**
     * @param Criteria $criteria
     * @return SearchByManager
     * @throws InvalidArgumentException
     */
    protected function criteriaManager(Criteria $criteria): SearchByManager
    {
        $this->manageSpecification($criteria->getSpecification());
        return $this;
    }

    /**
     * @param OrderBy $orderBy
     * @return SearchByManager
     * @throws InvalidArgumentException
     */
    protected function orderByManager(OrderBy $orderBy): SearchByManager
    {
        $orders = $orderBy->getOrders();
        foreach ($orders as &$order) {
            $order['field'] = $this->fieldsDefinition->getField($order['field']);
        } unset($order);

        $orderBy->setOrders($orders);
        return $this;
    }

    /**
     * @param SpecificationInterface $specification
     * @return SpecificationInterface
     * @throws InvalidArgumentException
     */
    public function manageSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return $specification->manageSpecificationForManager($this);
    }
}
