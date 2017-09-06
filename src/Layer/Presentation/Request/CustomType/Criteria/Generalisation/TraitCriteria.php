<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;

/**
 * Trait TraitCriteria
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage CustomTypeCriteria\Generalisation
 */
trait TraitCriteria
{
    /** @var Criteria */
    protected $criteria;

    /**
     * {@inheritdoc}
     */
    public function setCriteria(Criteria $criteria)
    {
        $this->criteria = $criteria;
        return $this;
    }
}
