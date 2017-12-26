<?php

namespace OW\CommunicationBundle\Builder\Email;

/**
 * Class HelloWorldEmailBuilder
 *
 * @package OW\CommunicationBundle\Builder\Email
 */
class HelloWorldEmailBuilder extends AbstractEmailBuilder
{
    /**
     * @return string|null
     */
    protected function getReceiver(): ?string
    {
        return 'hello_wordl@ow.pl';
    }

    /**
     * @return string
     */
    protected function getSubject(): string
    {
        return "Hello world!";
    }

    /**
     * @return string
     */
    protected function getTemplate(): string
    {
        return '@OWCommunication/Email/hello_world_email.html.twig';
    }

    /**
     * @return array
     */
    protected function getAttachments(): array
    {
        return [];
    }

    /**
     * Sets options to validate and merge them with default values.
     *
     * <code>
     *     $this->resolver
     *          ->setRequired([
     *              'user'
     *          ])
     *          ->setAllowedTypes('user', User::class);
     * </code>
     */
    protected function configureParameters()
    {
        $this->resolver
            ->setRequired([
                'name'
            ]);
    }
}