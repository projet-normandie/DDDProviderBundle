<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Query;

/**
 * Interface QueryRequestInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Query
 */
interface QueryRequestInterface
{
    /**
     * @return array
     */
    public function getRequestParameters(): array;
}
