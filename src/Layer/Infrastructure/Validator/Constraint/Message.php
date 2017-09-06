<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation\TraitRegex;

/**
 * Class Message
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class Message extends AbstractConstraint
{
    use TraitRegex;

    /**
     * @var string
     */
    public $message = 'The message "%string%" contains an illegal character.';

    /**
     * {@inheritdoc}
     */
    public function __construct($options = [])
    {
        parent::__construct(\array_merge(['regex' => '/^[\w\p{P}\s€$£]{1,255}$/u'], $options));
    }
}
