<?php
declare(strict_types = 1);

namespace ProjetNormandie\DddProviderBundle\Layer\Infrastructure\Serializer;

use JMS\Serializer\SerializationContext;

/**
 * Interface SerializerInterface
 *
 * @category ProjetNormandie\DddProviderBundle\Layer
 * @package Infrastructure
 * @subpackage Serializer
 */
interface SerializerInterface
{
    /**
     * @param mixed $data
     * @param string $format
     * @return string
     */
    public function serialize($data, string $format): string;

    /**
     * @param mixed $data
     * @param string $format
     * @return mixed
     */
    public function deserialize($data, string $format);

    /**
     * @return SerializationContext
     */
    public function getSerializationContext(): SerializationContext;

    /**
     * @param SerializationContext $context
     * @return mixed
     */
    public function setSerializationContext(SerializationContext $context);
}
