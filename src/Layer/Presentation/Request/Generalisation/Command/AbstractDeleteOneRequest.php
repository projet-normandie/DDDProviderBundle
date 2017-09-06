<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command;

/**
 * Abstract Class AbstractDeleteOneRequest
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Command
 * @abstract
 */
abstract class AbstractDeleteOneRequest extends AbstractCommandRequest
{
    /**
     * @var array
     */
    protected $defaults = [
        'revision' => ''
    ];

    /**
     * @var array
     */
    protected $required = ['entityId'];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'entityId' => ['string'],
        'revision' => ['string']
    ];
}
