<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query;

use Exception;
use LogicException;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\{
    InvalidCustomTypeException, PresentationException
};
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\Presentation\CriteriaException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\{Criteria, Limit, OrderBy};
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Generalisation\{
    CriteriaInterface, TraitCriteria
};
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request\RequestInterface;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Resolver\ResolverInterface;

/**
 * Abstract Class AbstractSearchByRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Query
 * @abstract
 */
abstract class AbstractSearchByRequest extends AbstractQueryRequest implements CriteriaInterface
{
    use TraitCriteria;

    /**
     * @var array
     */
    protected $defaults = [
        'orderBy' => null,
        'limit' => ['start' => 0, 'count' => 10]
    ];

    /**
     * @var array
     */
    protected $required = ['criteria'];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'criteria' => [Criteria::class],
        'limit' => [Limit::class],
        'orderBy' => ['null', OrderBy::class]
    ];

    /**
     * Overwrite default constructor to set the Criteria manager as a service.
     *
     * @param RequestInterface $request
     * @param ResolverInterface $resolver
     * @param Criteria $criteria
     * @throws PresentationException
     * @throws LogicException
     */
    public function __construct(RequestInterface $request, ResolverInterface $resolver, Criteria $criteria)
    {
        $this->setCriteria($criteria);
        parent::__construct($request, $resolver);
    }

    /**
     * {@inheritdoc}
     */
    protected function process(): void
    {
        $this->allowedValues['limit'] = Limit::getClosureValidation();
        $this->allowedValues['orderBy'] = OrderBy::getClosureValidation();
        parent::process();
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     * @throws CriteriaException
     * @throws InvalidCustomTypeException
     */
    protected function setOptions()
    {
        parent::setOptions();

        if (!isset($this->options['criteria'])) {
            throw CriteriaException::missingCriteria();
        }

        $this->options['criteria'] = $this->criteria->init($this->options['criteria']);
        $this->options['limit'] = new Limit($this->options['limit'] ?? $this->defaults['limit']);
        $this->options['orderBy'] = new OrderBy($this->options['orderBy'] ?? $this->defaults['orderBy']);
        return $this;
    }
}
