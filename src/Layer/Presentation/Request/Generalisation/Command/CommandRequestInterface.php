<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\Generalisation\Command;

/**
 * Interface CommandRequestInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\Generalisation\Command
 */
interface CommandRequestInterface
{
    /**
     * @return array
     */
    public function getRequestParameters(): array;
}
