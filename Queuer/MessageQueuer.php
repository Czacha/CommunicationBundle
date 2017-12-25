<?php

namespace OW\CommunicationBundle\Queuer;

use OW\CommunicationBundle\Builder\AbstractMessageBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MessageQueuer
 *
 * @package OW\CommunicationBundle\Sender
 */
class MessageQueuer implements MessageQueuerInterface
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * MessageQueuer constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $messageBuilderClass
     * @param array $parameters
     * @param array $customData
     */
    public function addMessageToQueue(string $messageBuilderClass, array $parameters = [], array $customData = [])
    {
        /** @var AbstractMessageBuilder $builder */
        $builder = new $messageBuilderClass($this->container);

        if (!$builder instanceof AbstractMessageBuilder) {
            throw new \InvalidArgumentException($messageBuilderClass . " must extends " . AbstractMessageBuilder::class);
        }

        $builder->build($parameters, $customData);
    }
}