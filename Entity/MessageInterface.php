<?php

namespace OW\CommunicationBundle\Entity;

/**
 * Interface MessageInterface
 *
 * @package OW\CommunicationBundle\Entity\Message\Model
 */
interface MessageInterface
{
    public function getReceiver(): string;
    public function setReceiver(string $receiver): void;

    public function getBody(): string;
    public function setBody(string $body): void;

    public function getErrorCount(): int;
    public function setErrorCount(int $errorCount): void;

    public function getCreatedAt(): \DateTime;
    public function setCreatedAt(\DateTime $createdAt): void;

    public function getScheduledSendAt(): ?\DateTime;
    public function setScheduledSendAt(?\DateTime $scheduledSendAt): void;

    public function getSentAt(): ?\DateTime;
    public function setSentAt(?\DateTime $sentAt): void;
}