<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\Handler;

use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Command\AbstractDeleteOneCommand;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandHandlerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Manipulation\TypeHinting\TraitStdClass;

/**
 * Abstract Class AbstractDeleteOneCommandHandler
 *
 * @category   ProjetNormandie\DddProviderBundle\Layer
 * @package    Application
 * @subpackage Generalisation\Command\Handler
 * @abstract
 */
abstract class AbstractDeleteOneCommandHandler implements CommandHandlerInterface
{
    use TraitStdClass;

    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     * @throws \ReflectionException
     */
    public function process(CommandInterface $command)
    {
        /** @var AbstractDeleteOneCommand $command */
        return $this->manager->process(self::buildFromDestination($command, AbstractDeleteOneCommand::class));
    }
}
