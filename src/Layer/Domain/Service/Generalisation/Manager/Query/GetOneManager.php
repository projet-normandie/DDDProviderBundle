<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Domain\Service\Generalisation\Manager\Query;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\DomainException;
use stdClass;

/**
 * Class GetOneManager
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Domain
 * @subpackage Service\Generalisation\Manager\Query
 */
class GetOneManager extends AbstractQueryManager
{
    use TraitFetchSingleEntity;

    /**
     * {@inheritdoc}
     * @throws DomainException
     */
    public function process(stdClass $object)
    {
        return $this->fetchSingleEntity($object);
    }
}
