<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository\Orm;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Trait TraitSave
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository\Orm
 */
trait TraitSave
{
    /**
     * {@inheritdoc}
     */
    public function save($entity)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->em;

        $em->persist($entity);
        $em->flush();

        return $entity;
    }
}
