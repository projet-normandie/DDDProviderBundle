<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareCommandBody;

use ProjetNormandie\DddProviderBundle\Layer\Domain\Generalisation\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitPatchBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareCommandBody
 */
trait TraitPatchBody
{
    /**
     * Prepare the success array body that will be returned by all patch actions.
     *
     * @param EntityInterface[] $entities
     * @param string|null $message
     * @return array
     */
    protected function prepareSuccess(array $entities, string $message = null): array
    {
        $body = [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'results' => $entities
        ];

        //Remove empty or false elements.
        return \array_filter($body);
    }
}
