<?php

namespace OW\CommunicationBundle\Queuer;

/**
 * Interface MessageQueuerInterface
 *
 * @package OW\CommunicationBundle\Queuer
 */
interface MessageQueuerInterface
{
    /**
     * @param string $messageBuilderClass
     * @param array $parameters
     * @param array $customData
     * @return mixed
     */
    public function addMessageToQueue(string $messageBuilderClass, array $parameters = [], array $customData = []);
}