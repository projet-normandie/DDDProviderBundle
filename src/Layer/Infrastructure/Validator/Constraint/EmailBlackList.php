<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint;

/**
 * Class EmailBlackList
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint
 */
class EmailBlackList extends AbstractConstraint
{
    /**
     * @var string
     */
    public $message = 'Services of trash mail are not allowed here.';
}
