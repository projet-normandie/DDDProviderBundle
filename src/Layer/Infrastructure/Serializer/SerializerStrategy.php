<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Serializer;

use JMS\Serializer\SerializationContext;

/**
 * Class SerializerStrategy
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Serializer
 */
class SerializerStrategy implements SerializerInterface
{
    /**
     * @var mixed
     */
    protected $serializer;

    /**
     * @var SerializationContext
     */
    protected $serializationContext;

    /**
     * SerializerStrategy constructor.
     * @param $serializer
     */
    public function __construct($serializer)
    {
        $this->serializer = $serializer;
        $this->serializationContext = SerializationContext::create();
    }

    /**
     * @return SerializationContext
     */
    public function getSerializationContext(): SerializationContext
    {
        return $this->serializationContext;
    }

    /**
     * @param SerializationContext $context
     * @return SerializerStrategy
     */
    public function setSerializationContext(SerializationContext $context): SerializerStrategy
    {
        $this->serializationContext = $context;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, string $format): string
    {
        return $this->serializer->serialize($data, $format, $this->serializationContext);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, string $format)
    {
        return $this->serializer->deserialize($data, $format, $this->serializationContext);
    }
}
