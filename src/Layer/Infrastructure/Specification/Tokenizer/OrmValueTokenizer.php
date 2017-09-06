<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Specification\Tokenizer;

/**
 * Class OrmValueTokenizer
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Specification\Tokenizer
 */
class OrmValueTokenizer extends AbstractValueTokenizer
{
    /**
     * {@inheritdoc}
     */
    public function tokenize(array $parameters): string
    {
        // Move the internal pointer to the last parameter.
        \end($parameters);

        $index = \key($parameters);
        if (\is_numeric($index)) {
            // Define the token to "?X" where "X" is the key of the last defined parameter.
            return '?' . $index;
        }

        // Define the token to ":param_name" where "param_name" is the key of the last defined parameter.
        return ':' . $index;
    }
}
