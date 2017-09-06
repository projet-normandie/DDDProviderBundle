<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareQueryBody;

use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitGetByIdsBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareQueryBody
 */
trait TraitGetByIdsBody
{
    /**
     * Prepare the success array body that will be returned by all get query actions.
     *
     * @param array $entities
     * @return array
     */
    protected function prepareSuccess(array $entities): array
    {
        return [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'total_rows' => \count($entities),
            'results' => $entities
        ];
    }
}
