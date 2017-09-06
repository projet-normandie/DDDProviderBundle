<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareQueryBody;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Query\AbstractGetAllQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitGetAllBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareQueryBody
 */
trait TraitGetAllBody
{
    /**
     * Prepare the success array body that will be returned by all get all actions.
     *
     * @param array $entities
     * @param AbstractGetAllQuery $query
     * @return array
     */
    protected function prepareSuccess(array $entities, AbstractGetAllQuery $query): array
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
