<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Validator\Constraint\Generalisation;

/**
 * Trait TraitRegex
 * Define property and accessors that manage the validation thanks to a regular expression.
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Validator\Constraint\Generalisation
 */
trait TraitRegex
{
    /**
     * @var string
     */
    protected $regex = '';

    /**
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @param string $regex
     * @return $this
     */
    public function setRegex(string $regex)
    {
        $this->regex = $regex;
        return $this;
    }
}
