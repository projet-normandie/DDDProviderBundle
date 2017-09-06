<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Generalisation;

use Closure;

/**
 * Abstract Class AbstractCustomType
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Generalisation
 * @abstract
 */
abstract class AbstractCustomType implements CustomTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getClosureValidation(): Closure
    {
        return function (CustomTypeInterface $value) {
            return $value->validate();
        };
    }
}
