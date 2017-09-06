<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation\TraitRegex;

/**
 * Class Sex
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class Sex extends AbstractConstraint
{
    use TraitRegex;

    /**
     * @var string
     */
    public $message = 'Invalid sex "%string%". Possible values: M or F';

    /**
     * {@inheritdoc}
     */
    public function __construct($options = [])
    {
        parent::__construct(\array_merge(['regex' => '/^[M|F]+$/'], $options));
    }
}
