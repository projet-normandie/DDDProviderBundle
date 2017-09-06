<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Factory;

/**
 * Trait TraitRepositoryFactory
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Factory
 */
trait TraitRepositoryFactory
{
    /**
     * @var mixed
     */
    protected $entityManager;

    /**
     * TraitRepositoryFactory constructor.
     * @param mixed $em
     */
    public function __construct($em)
    {
        $this->entityManager = $em;
    }

    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
