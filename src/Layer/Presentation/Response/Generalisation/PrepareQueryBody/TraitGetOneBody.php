<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareQueryBody;

use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitGetOneBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareQueryBody
 */
trait TraitGetOneBody
{
    /**
     * Prepare the success array body that will be returned by all get query actions.
     *
     * @param mixed $entity
     * @return array
     */
    protected function prepareSuccess($entity): array
    {
        return [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'result' => $entity
        ];
    }
}
