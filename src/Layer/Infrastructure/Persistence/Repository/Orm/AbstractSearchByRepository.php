<?php
declare(strict_types=1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Doctrine\ORM\QueryBuilder;
use Exception;
use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Generalisation\Orm\{
    Query, TraitLimit, TraitOrderBy
};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\CriteriaRepositoryInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Handlers\OrmSpecificationHandler;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer\{
    OrmValueTokenizer, ValueTokenizerInterface
};
use stdClass;

/**
 * Abstract Class AbstractSearchByRepository
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 * @abstract
 */
abstract class AbstractSearchByRepository extends AbstractRepository implements CriteriaRepositoryInterface
{
    use TraitOrderBy;
    use TraitLimit;

    /**
     * @var OrmSpecificationHandler
     */
    protected $specHandler;

    /**
     * @var ValueTokenizerInterface
     */
    protected $valueTokenizer;

    /**
     * @var QueryBuilder $qb
     */
    protected $qb;

    /**
     * @return ValueTokenizerInterface
     */
    public function getValueTokenizer(): ValueTokenizerInterface
    {
        return $this->valueTokenizer;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param stdClass $oObject
     * @return mixed
     * @throws Exception
     */
    public function execute(stdClass $oObject)
    {
        $this->qb = $this->em->createQueryBuilder();

        $this->valueTokenizer = new OrmValueTokenizer();
        $specification = $oObject->criteria->getSpecification();
        $this->specHandler = new OrmSpecificationHandler($this->manageSpecification($specification));

        $this->setLimit($oObject->limit);
        $this->setOrderBy($oObject->orderBy);
        return $this->searchBy();
    }

    /**
     * @return mixed
     * @throws Exception
     */
    protected function searchBy()
    {
        $this->qb->select($this->alias)
            ->from($this->entityName, $this->alias)
            ->where($this->specHandler->renderSpecification());

        $this->additionalCriteria()
            ->addOrderByToQueryBuilder($this->qb, $this->alias)
            ->setLimitToQueryBuilder($this->qb);

        // Set the parameters to the QueryBuilder so the Query will be built with them.
        $this->qb->setParameters($this->specHandler->getSpecification()->getParameters());

        $query = new Query($this->qb);

        return [
            'results' => $query->getResults(),
            'total_rows' => $query->getTotalCount()
        ];
    }

    /**
     * @param SpecificationInterface $specification
     * @return SpecificationInterface
     */
    public function manageSpecification(SpecificationInterface $specification): SpecificationInterface
    {
        return $specification->manageSpecificationForRepository($this);
    }

    /**
     * Must be overload if you need to add additional criteria or element on query
     *
     * @return $this
     */
    protected function additionalCriteria()
    {
        return $this;
    }
}
