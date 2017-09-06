<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Generalisation;

use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria;

/**
 * Interface CriteriaInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Generalisation
 */
interface CriteriaInterface
{
    /**
     * Sets the criteria service option for the requests that need it.
     *
     * @param Criteria $criteria
     * @return $this
     */
    public function setCriteria(Criteria $criteria);
}
