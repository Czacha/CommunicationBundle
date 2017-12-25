<?php

namespace OW\CommunicationBundle\Entity;

/**
 * Interface EmailMessageInterface
 *
 * @package OW\CommunicationBundle\Entity\Message\Email
 */
interface EmailMessageInterface
{
    public function getSubject(): string;
    public function setSubject(string $subject): void;
}