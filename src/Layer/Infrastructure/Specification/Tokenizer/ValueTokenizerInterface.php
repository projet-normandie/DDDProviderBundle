<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer;

/**
 * Interface ValueTokenizerInterface.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Tokenizer
 */
interface ValueTokenizerInterface
{
    /**
     * Replaces parameters values by specific tokens according to the database type (ORM, ODM, CouchDB).
     *
     * @param array $parameters
     * @return string
     */
    public function tokenize(array $parameters): string;
}
