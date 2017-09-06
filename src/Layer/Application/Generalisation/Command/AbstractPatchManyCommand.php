<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use Countable;

/**
 * Abstract Class AbstractPatchManyCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractPatchManyCommand extends AbstractCommand implements Countable
{
    /**
     * @var AbstractPatchOneCommand[] List of PatchOneCommand objects to manage.
     */
    protected $patchOneCommands = [];

    /**
     * Constructs the PatchManyCommand object based on an array of all objects to manage.
     *
     * @param AbstractPatchOneCommand[] $patchOneCommands
     */
    public function __construct(array $patchOneCommands)
    {
        $this->patchOneCommands = $patchOneCommands;
    }

    /**
     * Returns the whole list of objects to manage.
     *
     * @return AbstractPatchOneCommand[]
     */
    public function getPatchOneCommands(): array
    {
        return $this->patchOneCommands;
    }

    /**
     * Retrieves a single object by its index.
     *
     * @param int $key
     * @return AbstractPatchOneCommand|null
     */
    public function getByIndex(int $key): ?AbstractPatchOneCommand
    {
        return $this->patchOneCommands[$key] ?? null;
    }

    /**
     * Returns a conversion into an array of all objects to manage.
     *
     * @param bool $skipNull Boolean that asks if you need to skip objects that are null. False by default.
     * @return array
     */
    public function toArray(bool $skipNull = false): array
    {
        $command = [];
        foreach ($this->patchOneCommands as $patchOneCommand) {
            $command[] = $patchOneCommand->toArray($skipNull);
        }
        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->patchOneCommands);
    }
}
