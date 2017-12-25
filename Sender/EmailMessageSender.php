<?php

namespace OW\CommunicationBundle\Sender;

use OW\CommunicationBundle\Entity\Email;
use OW\CommunicationBundle\Entity\EmailMessageInterface;
use OW\CommunicationBundle\Entity\Message;
use OW\CommunicationBundle\Entity\MessageInterface;

/**
 * Class EmailMessageSender
 *
 * @package OW\CommunicationBundle\Sender
 */
class EmailMessageSender extends MessageSender
{
    /**
     * @return array
     */
    protected function getMessagesToSend(): array
    {
        return $this
            ->getMessagesToSendQB(Email::class)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param MessageInterface $message
     */
    protected function send(MessageInterface $message): void
    {
        if (!$message instanceof EmailMessageInterface) {
            throw new \InvalidArgumentException("Email class must implement " . EmailMessageInterface::class);
        }

        $email = new \Swift_Message();
        $email->setFrom($this->getMessageAuthor());
        $email->setTo($message->getReceiver());
        $email->setSubject($message->getSubject());
        $email->setBody(
            $message->getBody(),
            'text/html'
        );

        $this->getMailer()->send($email);
    }

    /**
     * @return object|\Swift_Mailer
     */
    private function getMailer()
    {
        return $this->container->get('mailer');
    }

    /**
     * @return string
     */
    private function getMessageAuthor()
    {
        return $this->container->getParameter('config.communication')['message_author_email'];
    }
}