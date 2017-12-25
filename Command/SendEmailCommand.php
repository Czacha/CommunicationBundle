<?php

namespace OW\CommunicationBundle\Command;

use OW\CommunicationBundle\Sender\EmailMessageSender;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SendEmailCommand
 *
 * @package OW\CommunicationBundle\Command
 */
class SendEmailCommand extends BaseEndlessCommand
{
    /** @var EmailMessageSender */
    private $messageSender;

    /**
     * SendEmailCommand constructor.
     * @param null $name
     * @param EmailMessageSender $emailMessageSender
     */
    public function __construct($name = null, EmailMessageSender $emailMessageSender)
    {
        parent::__construct($name);
        $this->messageSender = $emailMessageSender;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('communication:email:send');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->messageSender->sendMessages();
    }
}
