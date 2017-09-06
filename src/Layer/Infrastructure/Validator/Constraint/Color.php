<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation\TraitRegex;

/**
 * Class Color
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class Color extends AbstractConstraint
{
    use TraitRegex;

    /**
     * @var string
     */
    public $message = 'Invalid color code "%string%"';

    /**
     * {@inheritdoc}
     */
    public function __construct($options = [])
    {
        parent::__construct(\array_merge(['regex' => '/^#([a-f0-9]{3}){1,2}$/i'], $options));
    }
}
