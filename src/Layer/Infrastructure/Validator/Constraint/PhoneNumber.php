<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation\TraitRegex;

/**
 * Class PhoneNumber
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class PhoneNumber extends AbstractConstraint
{
    use TraitRegex;

    /**
     * @var string
     */
    public $message = 'Invalid phone number "%string%". It can only contain numbers.';

    /**
     * {@inheritdoc}
     * todo: regex can be improved!
     */
    public function __construct($options = [])
    {
        parent::__construct(\array_merge(['regex' => '/^\+?(?:\d){6,14}\d$/'], $options));
    }
}
