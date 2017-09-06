<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\PrepareCommandBody;

use Symfony\Component\HttpFoundation\Response;

/**
 * Trait TraitDeleteBody
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\PrepareCommandBody
 */
trait TraitDeleteBody
{
    /**
     * Prepare the success array body that will be returned by all delete actions.
     *
     * @param string|null $message
     * @return array
     */
    protected function prepareSuccess(string $message = null): array
    {
        $body = [
            'status' => 'success',
            'code' => Response::HTTP_OK,
            'message' => $message
        ];

        //Remove empty or false elements.
        return \array_filter($body);
    }
}
