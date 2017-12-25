<?php


namespace OW\CommunicationBundle\Command;

use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Log\Logger;
use Wrep\Daemonizable\Command\EndlessContainerAwareCommand;

/**
 * Class BaseEndlessCommand
 *
 * @package OW\CommunicationBundle\Command
 */
abstract class BaseEndlessCommand extends EndlessContainerAwareCommand
{
    use LockableTrait;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function starting(InputInterface $input, OutputInterface $output)
    {
        parent::starting($input, $output);

        $this->logger = $this->getContainer()->get('logger');

        if (!$this->lock(md5(dirname(__FILE__) . '|' . get_class($this)))) {
            $this->logger->error('Another instance of ' . get_class($this) . ' is running');

            die;
        }
    }

}