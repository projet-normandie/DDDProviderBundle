<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;

/**
 * Abstract Class AbstractCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * transform command to array
     * skip null or empty value if $skipNull is true
     *
     * @param bool|false $skipNull
     * @return array
     */
    public function toArray(bool $skipNull = false): array
    {
        $tab = \get_object_vars($this);
        $tab = \is_array($tab) ? $tab : [];

        if ($skipNull) {
            $tab = \array_filter($tab, function ($property) {
                return '' !== $property && null !== $property;
            });
        }

        return $tab;
    }
}
