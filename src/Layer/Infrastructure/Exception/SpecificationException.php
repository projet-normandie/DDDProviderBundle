<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception Class SpecificationException
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Exception
 */
class SpecificationException extends Exception
{
    /**
     * @var array Array of data to describe errors
     */
    protected $data;

    /**
     * @param string $message
     * @param array $data
     * @param Exception|null $previous
     */
    public function __construct($message = '', array $data = [], Exception $previous = null)
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST, $previous);
        $this->data = $data;
    }

    /**
     * Returns the <Unsatisfied Specification> Exception.
     *
     * @param $data
     * @return SpecificationException
     */
    public static function unsatisfiedSpecification($data): SpecificationException
    {
        return new static('Unsatisfied specifications', $data);
    }

    /**
     * Returns the <Bad Interface Specification> Exception.
     *
     * @return SpecificationException
     */
    public static function badInterfaceSpecification(): SpecificationException
    {
        return new static('bad format specification for specHandler. It must be an InterfaceSpecification');
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
