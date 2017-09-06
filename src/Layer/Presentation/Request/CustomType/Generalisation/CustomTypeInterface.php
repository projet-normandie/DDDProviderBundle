<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Generalisation;

use Closure;

/**
 * Interface CustomTypeInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Generalisation
 */
interface CustomTypeInterface
{
    /**
     * Returns a closure to be ran on each value of the specific custom type, mainly to validate them.
     * @return Closure
     */
    public static function getClosureValidation(): Closure;

    /**
     * Validate the data structure given compared to the structure defined in the custom type inherited.
     * @return bool
     */
    public function validate(): bool;
}
