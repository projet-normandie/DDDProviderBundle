<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Specification;

/**
 * Trait TraitReplacements
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Specification
 */
trait TraitReplacements
{
    /** @var array */
    protected static $replacements = [];

    /**
     * @return string[]
     */
    public function getReplacements(): array
    {
        return static::$replacements;
    }

    /**
     * @param int|string $index
     * @param string $replacement
     * @return $this
     */
    public function addReplacement($index, string $replacement)
    {
        // todo: add refactoring of this.
        if (\is_int($index)) {
            static::$replacements[] = $replacement;
        } else {
            static::$replacements[$index] = $replacement;
        }

        return $this;
    }

    /**
     * Returns and cleans all replacements defined. Returns only the replacement if only one defined.
     *
     * @return string|string[]
     */
    public function getCleanReplacements()
    {
        $replacements = [static::$replacements, \reset(static::$replacements)][1 === \count(static::$replacements)];
        static::$replacements = [];
        return $replacements;
    }
}
