<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Abstract Class AbstractConstraint
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 * @abstract
 */
abstract class AbstractConstraint extends Constraint
{
    /**
     * @var string Specific message that can be defined to overwrite possible default message.
     */
    public $message = '';

    /**
     * Returns the name of the class that will validate this constraint.
     * The class name of the validator is calculated thanks to the namespace and the name of the given constraint.
     *
     * For example, for the constraint \Constraint\Foo, the validator will be \ConstraintValidator\FooValidator
     *
     * @return string
     */
    public function validatedBy(): string
    {
        $sFQN = \get_class($this);
        $namespaceClassName = \substr($sFQN, 0, \strrpos($sFQN, '\\'));
        $className = \substr($sFQN, \strrpos($sFQN, '\\'));

        return $namespaceClassName . 'Validator' . $className . 'Validator';
    }
}
