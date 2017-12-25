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
}