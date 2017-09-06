<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Criteria\Registry;

/**
 * Abstract Class AbstractOperatorRegistry
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType\Criteria\Registry
 */
abstract class AbstractOperatorRegistry implements OperatorRegistryInterface
{
    /**
     * @var string[] List of operators.
     */
    protected $operators = [];

    /**
     * {@inheritdoc}
     */
    public function getOperators(): array
    {
        return $this->operators;
    }

    /**
     * {@inheritdoc}
     */
    public function setOperator(string $className): OperatorRegistryInterface
    {
        /** @noinspection PhpUndefinedFieldInspection
         * This field is mandatory in each operator and the $className must be an operator class name.
         */
        $this->operators[$className::IDENTIFIER] = $className;
        return $this;
    }
}
