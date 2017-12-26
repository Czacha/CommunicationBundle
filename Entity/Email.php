<?php

namespace OW\CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Email
 *
 * @package OW\CommunicationBundle\Entity\Message\Email
 *
 * @ORM\Entity()
 */
class Email extends Message implements EmailMessageInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(type="array")
     */
    protected $attachments;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->attachments = [];
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return array
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     */
    public function setAttachments(?array $attachments): void
    {
        $this->attachments = $attachments;
    }
}