<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ResponseHandlerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation
 */
interface ResponseHandlerInterface
{
    /**
     * @param null $data
     * @param null|int $statusCode
     * @param array $headers
     * @return mixed
     */
    public function create($data = null, $statusCode = Response::HTTP_OK, array $headers = []);
    
    /**
     * @return mixed
     */
    public function getResponse();
}
