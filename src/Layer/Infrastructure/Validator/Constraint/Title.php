<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation\TraitRegex;

/**
 * Class Title
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class Title extends AbstractConstraint
{
    use TraitRegex;

    /**
     * @var string
     */
    public $message = 'The string %string% contains an illegal character: it can only contain words.';

    /**
     * {@inheritdoc}
     */
    public function __construct($options = [])
    {
        parent::__construct(\array_merge(['regex' => '/^[a-zA-Z0-9_\- ]+$/u'], $options));
    }
}
