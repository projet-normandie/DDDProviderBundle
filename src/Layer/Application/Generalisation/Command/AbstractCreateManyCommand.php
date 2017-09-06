<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command;

use Countable;

/**
 * Abstract Class AbstractCreateManyCommand
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Command
 * @abstract
 */
abstract class AbstractCreateManyCommand extends AbstractCommand implements Countable
{
    /**
     * @var AbstractCreateOneCommand[] List of CreateOneCommand objects to manage.
     */
    protected $createOneCommands = [];

    /**
     * Constructs the CreateManyCommand object based on an array of all objects to manage.
     *
     * @param AbstractCreateOneCommand[] $createOneCommands
     */
    public function __construct(array $createOneCommands)
    {
        $this->createOneCommands = $createOneCommands;
    }

    /**
     * Returns the whole list of objects to manage.
     *
     * @return AbstractCreateOneCommand[]
     */
    public function getCreateOneCommands(): array
    {
        return $this->createOneCommands;
    }

    /**
     * Retrieves a single object by its index.
     *
     * @param int $key
     * @return AbstractCreateOneCommand|null
     */
    public function getByIndex(int $key): ?AbstractCreateOneCommand
    {
        return $this->createOneCommands[$key] ?? null;
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
        foreach ($this->createOneCommands as $createOneCommand) {
            $command[] = $createOneCommand->toArray($skipNull);
        }
        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->createOneCommands);
    }
}
