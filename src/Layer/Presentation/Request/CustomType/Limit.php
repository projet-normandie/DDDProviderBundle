<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType;

use Nicodev\Asserts\TraitAssertCountable;
use ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Exception\InvalidCustomTypeException;
use ProjetNormandie\DddProviderBundle\Layer\Presentation\Request\CustomType\Generalisation\AbstractCustomType;

/**
 * Class Limit
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Presentation
 * @subpackage Request\CustomType
 */
class Limit extends AbstractCustomType
{
    use TraitAssertCountable;

    /** @var int */
    protected $start = 0;

    /** @var int */
    protected $count = 10;

    /**
     * Limit constructor.
     *
     * @param array $subProperties
     * @throws \Exception
     */
    public function __construct(array $subProperties)
    {
        $this->init('start', $subProperties)
            ->init('count', $subProperties);

        static::assertEmpty($subProperties, InvalidCustomTypeException::unknownExtraFields('limit', $subProperties));
    }

    /**
     * Initializes a property of the limit based on the property key, the setter to call and the list of properties.
     *
     * @param string $key Must be "start" or "count".
     * @param array $subProperties
     * @return Limit
     */
    protected function init(string $key, array &$subProperties): Limit
    {
        $method = 'set' . \ucfirst($key);

        if (\array_key_exists($key, $subProperties) && \method_exists($this, $method)) {
            $this->{$method}($subProperties[$key]);
            unset($subProperties[$key]);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @return null|int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int $start
     * @return Limit
     */
    public function setStart(int $start): Limit
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param null|int $count
     * @return Limit
     */
    public function setCount(?int $count): Limit
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return $this->start >= 0 && (null === $this->count || $this->count >= 0);
    }
}
