<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\Repository;

use ProjetNormandie\DddProviderBundle\Layer\Application\Specification\SpecificationInterface;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer\ValueTokenizerInterface;

/**
 * Interface CriteriaRepositoryInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\Repository
 */
interface CriteriaRepositoryInterface
{
    /**
     * Returns the alias defined in the repository.
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Returns the value tokenizer used to replace values of the criteria by tokens.
     *
     * @return ValueTokenizerInterface
     */
    public function getValueTokenizer(): ValueTokenizerInterface;

    /**
     * Manages a specification to replace criteria fields by adding alias to field names and tokenize criteria values.
     *
     * @param SpecificationInterface $specification
     * @return SpecificationInterface
     */
    public function manageSpecification(SpecificationInterface $specification): SpecificationInterface;
}
