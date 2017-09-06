<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use Countable;

/**
 * Abstract Class AbstractUpdateManyCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractUpdateManyCommand extends AbstractCommand implements Countable
{
    /**
     * @var AbstractUpdateOneCommand[] List of UpdateOneCommand objects to manage.
     */
    protected $updateOneCommands = [];

    /**
     * Constructs the UpdateManyCommand object based on an array of all objects to manage.
     *
     * @param AbstractUpdateOneCommand[] $updateOneCommands
     */
    public function __construct(array $updateOneCommands)
    {
        $this->updateOneCommands = $updateOneCommands;
    }

    /**
     * Returns the whole list of objects to manage.
     *
     * @return AbstractUpdateOneCommand[]
     */
    public function getUpdateOneCommands(): array
    {
        return $this->updateOneCommands;
    }

    /**
     * Retrieves a single object by its index.
     *
     * @param int $key
     * @return AbstractUpdateOneCommand|null
     */
    public function getByIndex(int $key): ?AbstractUpdateOneCommand
    {
        return $this->updateOneCommands[$key] ?? null;
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
        foreach ($this->updateOneCommands as $updateOneCommand) {
            $command[] = $updateOneCommand->toArray($skipNull);
        }
        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->updateOneCommands);
    }
}
