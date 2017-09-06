<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareQueryBody;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query\AbstractSearchByQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitSearchByBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareQueryBody
 */
trait TraitSearchByBody
{
    /**
     * Prepare the success array body that will be returned by all get query actions.
     *
     * @param mixed $entities
     * @param AbstractSearchByQuery $query
     * @return array
     */
    protected function prepareSuccess($entities, AbstractSearchByQuery $query): array
    {
        return [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'total_rows' => $entities['total_rows'],
            'start' => $query->getLimit()->getStart(),
            'count' => $query->getLimit()->getCount(),
            'results' => $entities['results']
        ];
    }
}
