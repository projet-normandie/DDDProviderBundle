<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Interface ValidatorInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Validation\ValidationHandler
 */
interface ValidatorInterface
{
    /**
     * @param mixed $data
     * @param array $constraints
     * @return ConstraintViolationListInterface
     */
    public function validateValue($data, array $constraints): ConstraintViolationListInterface;
}
