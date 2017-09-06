<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Persistence\FieldsDefinition;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidArgumentException;

/**
 * Abstract Class FieldsDefinitionAbstract
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Persistence\FieldsDefinition
 */
abstract class FieldsDefinitionAbstract
{
    /**
     * @var string[] Associative array where keys are parameters names from the request and values are db fields names.
     */
    protected $fields;

    /**
     * Returns the name of the database field according to the name of the request parameter.
     *
     * @param string $field
     * @return string
     * @throws InvalidArgumentException
     */
    public function getField(string $field): string
    {
        if (isset($this->fields[$field])) {
            return $this->fields[$field];
        }

        throw InvalidArgumentException::invalidField($field, \array_keys($this->fields));
    }
}
