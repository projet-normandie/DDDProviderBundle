<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Response\Generalisation\Version;

/**
 * Class VersionGetterComposite
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Response\Generalisation\Version
 */
class VersionGetterComposite implements VersionGetterInterface
{
    /**
     * @var VersionGetterInterface[]
     */
    protected $versionGetters = [];

    /**
     * Adds a VersionInterface.
     *
     * @param VersionGetterInterface $versionGetter
     */
    public function addVersionGetter(VersionGetterInterface $versionGetter): void
    {
        $this->versionGetters[] = $versionGetter;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion(): ?int
    {
        foreach ($this->versionGetters as $versionGetter) {
            $version = $versionGetter->getVersion();
            if (null !== $version) {
                return $version;
            }
        }

        return null;
    }
}
