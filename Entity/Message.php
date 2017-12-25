<?php

namespace OW\CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="OW\CommunicationBundle\Repository\MessageRepository")
 * @ORM\Table(name="communication")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "email" = "OW\CommunicationBundle\Entity\Email"
 * })
 */
abstract class Message implements MessageInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $receiver;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $errorCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\GreaterThan("now")
     */
    protected $scheduledSendAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $sentAt;

    /**
     * BaseMessage constructor.
     */
    public function __construct()
    {
        $this->errorCount = 0;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     */
    public function setReceiver(string $receiver): void
    {
        $this->receiver = $receiver;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    /**
     * @param int $errorCount
     */
    public function setErrorCount(int $errorCount): void
    {
        $this->errorCount = $errorCount;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getScheduledSendAt(): ?\DateTime
    {
        return $this->scheduledSendAt;
    }

    /**
     * @param \DateTime $scheduledSendAt
     */
    public function setScheduledSendAt(?\DateTime $scheduledSendAt): void
    {
        $this->scheduledSendAt = $scheduledSendAt;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }

    /**
     * @param \DateTime $sentAt
     */
    public function setSentAt(?\DateTime $sentAt): void
    {
        $this->sentAt = $sentAt;
    }
}