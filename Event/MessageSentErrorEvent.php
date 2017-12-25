<?php

namespace OW\CommunicationBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class MessageSendErrorEvent
 *
 * @package OW\CommunicationBundle\Event
 */
class MessageSentErrorEvent extends Event
{
    const NAME = 'communication.message_sent_error';

    /**
     * @var \Exception
     */
    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

}