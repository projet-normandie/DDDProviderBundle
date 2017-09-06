<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer;

/**
 * Abstract Class AbstractValueTokenizer
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Tokenizer
 * @abstract
 */
abstract class AbstractValueTokenizer implements ValueTokenizerInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function tokenize(array $parameters): string;
}
