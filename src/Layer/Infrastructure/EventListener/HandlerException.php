<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\EventListener;

use /** @noinspection PhpUndefinedClassInspection AppKernel belongs to a service that uses this one. */ AppKernel;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HandlerException
 * Custom Exception handler.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage EventListener
 */
class HandlerException
{
    /**
     * Event handler that renders not found page in case of a NotFoundHttpException
     *
     * @param GetResponseForExceptionEvent $event
     *
     * @access public
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        // exception object
        $exception = $event->getException();

        $httpCode = static::getHttpCode($exception);

        $body = [
            'status' => 'error',
            'code' => $httpCode,
            'message' => $exception->getMessage(),
        ];

        // If the Exception type managed data, set it to the body.
        if (\method_exists($exception, 'getData')) {
            $body['results'] = $exception->getData();
        }

        // HttpExceptionInterface is a special type of exception that holds status code.
        if (\method_exists($exception, 'getStatusCode')) {
            $httpCode = $exception->getStatusCode();
        }

        // new Response object
        $response = new JsonResponse(\array_filter($body), $httpCode);

        // HttpExceptionInterface also holds header details.
        if (\method_exists($exception, 'getHeaders')) {
            $response->headers->replace($exception->getHeaders());
        }

        // set the new $response object to the $event
        $event->setResponse($response);
    }

    /**
     * Return the HTTP code we want based on the type and the code of the exception.
     *
     * @param \Exception $exception
     * @return int
     */
    private static function getHttpCode(\Exception $exception): int
    {
        // For Symfony specific exceptions, overload the HTTP error code.
        if ($exception instanceof UndefinedOptionsException || $exception instanceof MissingOptionsException) {
            // For these exception types, error code is 400 : BAD_REQUEST.
            $httpCode = Response::HTTP_BAD_REQUEST;
        } elseif (0 !== $exception->getCode()) {
            // HTTP status code is the exception code if defined.
            $httpCode = $exception->getCode();
        } else {
            // Otherwise, the 500 : HTTP_INTERNAL_SERVER_ERROR is used.
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $httpCode;
    }
}
