<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;

/**
 * Exception Class WorkflowException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class WorkflowException extends Exception
{
    /**
     * Returns the <No Created Entity> Exception.
     *
     * @return WorkflowException
     */
    public static function noCreatedEntity(): WorkflowException
    {
        return new static('Entity has not been created');
    }
}
