<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Handler;

use Symfony\Component\HttpFoundation\Response;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\ResponseHandlerInterface;

/**
 * Class ResponseHandler.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Handler
 */
class ResponseHandler implements ResponseHandlerInterface
{
    use TraitResponseHandler;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Convenience method to allow for a fluent interface.
     *
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return ResponseHandler
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function create($data = null, $statusCode = Response::HTTP_OK, array $headers = []): ResponseHandler
    {
        // The $headers array must contain the "Content-Type" element.
        // Use the format of the request if not defined.
        if (!\array_key_exists('Content-Type', $headers)) {
            $headers['Content-Type'] = $this->getRequest()->getMimeType($this->getFormat());
        }

        // Parse the data in the serializer.
        if (null !== $data) {
            $data = $this->getSerializer()->serialize($data, $this->getFormat());
        }

        $this->response = new Response($data, $statusCode, $headers);
        return $this;
    }

    /**
     * Gets the response.
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Gets the HTTP status code.
     *
     * @return int|null
     * @throws \InvalidArgumentException
     */
    protected function getStatusCode(): ?int
    {
        return $this->getResponse()->getStatusCode();
    }

    /**
     * Gets the headers.
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function getHeaders(): array
    {
        return $this->getResponse()->headers->all();
    }
}
