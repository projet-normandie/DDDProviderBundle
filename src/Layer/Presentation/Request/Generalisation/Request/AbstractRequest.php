<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Request;

use Symfony\Component\HttpFoundation\{FileBag, HeaderBag, ParameterBag, ServerBag};

/**
 * Abstract Class AbstractRequest
 * Default Abstract of the Request strategy.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Request
 * @abstract
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * Custom parameters.
     *
     * @var ParameterBag
     */
    public $attributes;

    /**
     * Query string parameters ($_GET).
     *
     * @var ParameterBag
     */
    public $query;

    /**
     * Server and execution environment parameters ($_SERVER).
     *
     * @var ServerBag
     */
    public $server;

    /**
     * Uploaded files ($_FILES).
     *
     * @var FileBag
     */
    public $files;

    /**
     * Cookies ($_COOKIE).
     *
     * @var ParameterBag
     */
    public $cookies;

    /**
     * Headers (taken from the $_SERVER).
     *
     * @var HeaderBag
     */
    public $headers;
}
