<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version;

/**
 * Interface VersionGetterInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\Version
 */
interface VersionGetterInterface
{
    /**
     * Returns the version of the API used.
     *
     * @return int|null
     */
    public function getVersion(): ?int;
}
