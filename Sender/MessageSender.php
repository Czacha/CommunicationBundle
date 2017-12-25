<?php

namespace OW\CommunicationBundle\Sender;

use OW\CommunicationBundle\Entity\Message;
use OW\CommunicationBundle\Entity\MessageInterface;
use OW\CommunicationBundle\Event\MessageSentErrorEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MessageSender
 * @package OW\CommunicationBundle\Sender
 */
abstract class MessageSender
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * @return MessageInterface[]
     */
    abstract protected function getMessagesToSend();

    /**
     * @param MessageInterface $message
     */
    abstract protected function send(MessageInterface $message);

    /**
     * MessageSender constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function sendMessages()
    {
        /** @var MessageInterface $message */
        foreach ($this->getMessagesToSend() as $message) {
            $this->sendMessage($message);
        }
    }

    /**
     * @param string $messageClass
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getMessagesToSendQB(string $messageClass)
    {
        return $this
            ->getEntityManager()
            ->getRepository(Message::class)
            ->getMessagesToSentQB(
                $messageClass,
                $this->getMaxMessageLimit(),
                $this->getMaxMessageErrorCount()
            );
    }

    /**
     * @param MessageInterface $message
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function sendMessage(MessageInterface $message)
    {
        try {
            $this->send($message);
            $message->setSentAt(new \DateTime());

        } catch (\Exception $exception) {
            $message->setErrorCount($message->getErrorCount() + 1);
            $this->getEventDispatcher()->dispatch(MessageSentErrorEvent::NAME, new MessageSentErrorEvent($exception));
        }

        $this->getEntityManager()->flush();
    }

    /**
     * @return integer
     */
    private function getMaxMessageLimit()
    {
        return $this->container->getParameter('config.communication')['max_messages_to_send'];
    }

    /**
     * @return integer
     */
    private function getMaxMessageErrorCount()
    {
        return $this->container->getParameter('config.communication')['max_error_count'];
    }

    /**
     * @return \Doctrine\ORM\EntityManager|object
     */
    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    /**
     * @return object|\Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher
     */
    protected function getEventDispatcher()
    {
        return $this->container->get('event_dispatcher');
    }

}