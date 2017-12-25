<?php

namespace OW\CommunicationBundle\Builder;

use OW\CommunicationBundle\Entity\MessageInterface;
use OW\CommunicationBundle\Exception\MessageException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class AbstractMessageBuilder
 *
 * @package OW\CommunicationBundle\Builder
 */
abstract class AbstractMessageBuilder
{
    /** @var ContainerInterface */
    protected $container;

    /** @var OptionsResolver */
    protected $resolver;

    /** @var array */
    protected $parameters;

    /** @var array */
    protected $customData;

    /**
     * @return string|null
     */
    abstract protected function getReceiver(): ?string ;

    /**
     * @return MessageInterface
     */
    abstract protected function buildMessage(): MessageInterface;

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
    abstract protected function configureParameters();

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->resolver = new OptionsResolver();
        $this->configureParameters();
    }

    /**
     * @param $key
     * @param $value
     */
    public function addParameter(string $key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param array $customData
     */
    public function setCustomData(array $customData)
    {
        $this->customData = $customData;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addCustomData(string $key, $value)
    {
        $this->customData[$key] = $value;
    }

    /**
     * @param array $parameters
     * @param array $customData
     * @param bool $addMessageToQueue
     * @return MessageInterface
     */
    public function build(array $parameters = [], array $customData = [], $addMessageToQueue = true): MessageInterface
    {
        if (!empty($parameters)) {
            $this->setParameters($parameters);
        }

        if (!empty($customData)) {
            $this->setCustomData($customData);
        }

        $this->resolver->resolve($this->parameters);

        $message = $this->buildMessage();

        /** @var ConstraintViolationListInterface $errors */
        $errors = $this->getValidator()->validate($message);

        if (count($errors)) {
            /** @var ConstraintViolationInterface $error */
            $error = $errors->get(0);

            throw new MessageException(sprintf('%s: %s', $error->getPropertyPath(), $error->getMessage()));
        }

        if ($addMessageToQueue) {
            $this->getEntityManager()->persist($message);
            $this->getEntityManager()->flush();
        }

        return $message;
    }

    /**
     * @return EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    protected function getValidator()
    {
        return $this->container->get('validator');
    }

}