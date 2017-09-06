<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use Countable;

/**
 * Abstract Class AbstractDeleteManyCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractDeleteManyCommand extends AbstractCommand implements Countable
{
    /**
     * @var AbstractDeleteOneCommand[] List of DeleteOneCommand objects to manage.
     */
    protected $deleteOneCommands = [];

    /**
     * Constructs the DeleteManyCommand object based on an array of all objects to manage.
     *
     * @param AbstractDeleteOneCommand[] $deleteOneCommands
     */
    public function __construct(array $deleteOneCommands)
    {
        $this->deleteOneCommands = $deleteOneCommands;
    }

    /**
     * Returns the whole list of objects to manage.
     *
     * @return AbstractDeleteOneCommand[]
     */
    public function getDeleteOneCommands(): array
    {
        return $this->deleteOneCommands;
    }

    /**
     * Retrieves a single object by its index.
     *
     * @param int $key
     * @return AbstractDeleteOneCommand|null
     */
    public function getByIndex(int $key): ?AbstractDeleteOneCommand
    {
        if (isset($this->deleteOneCommands[$key])) {
            return $this->deleteOneCommands[$key];
        }
        return null;
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
        foreach ($this->deleteOneCommands as $deleteOneCommand) {
            $command[] = $deleteOneCommand->toArray($skipNull);
        }
        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->deleteOneCommands);
    }
}
