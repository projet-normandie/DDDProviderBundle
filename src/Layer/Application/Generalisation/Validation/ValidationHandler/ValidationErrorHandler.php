<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Application\Generalisation\Validation\ValidationHandler;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationErrorHandler
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Application
 * @subpackage Generalisation\Validation\ValidationHandler
 */
class ValidationErrorHandler
{
    /**
     * @param ConstraintViolationListInterface $errors output of validator->validateValue() method
     * @return array
     */
    public static function arrayAll(ConstraintViolationListInterface $errors): array
    {
        $tab = [];
        foreach ($errors as $error) {
            $field = \substr($error->getPropertyPath(), 1, -1);
            $tab[$field] = $error->getMessage();
        }
        return $tab;
    }
}
