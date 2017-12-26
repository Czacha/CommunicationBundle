<?php
namespace OW\CommunicationBundle\Builder\Email;

use OW\CommunicationBundle\Builder\AbstractMessageBuilder;
use OW\CommunicationBundle\Entity\Email;
use OW\CommunicationBundle\Entity\MessageInterface;

/**
 * Class AbstractEmailBuilder
 *
 * @package OW\CommunicationBundle\Builder\Email
 */
abstract class AbstractEmailBuilder extends AbstractMessageBuilder
{
    /**
     * @return string
     */
    abstract protected function getSubject(): string;

    /**
     * @return string
     */
    abstract protected function getTemplate(): string;

    /**
     * @return array
     */
    abstract protected function getAttachments(): array;

    /**
     * @return MessageInterface
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function buildMessage(): MessageInterface
    {
        $email = new Email();
        $email->setReceiver($this->getReceiver());
        $email->setSubject($this->getSubject());
        $email->setBody(
            $this->getTwig()->render($this->getTemplate(), $this->parameters)
        );
        $email->setAttachments($this->getAttachments());

        return $email;
    }

    /**
     * @return object|\Twig\Environment
     */
    private function getTwig()
    {
        return $this->container->get('twig');
    }

}