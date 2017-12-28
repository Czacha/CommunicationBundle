<?php

namespace OW\CommunicationBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;
use OW\CommunicationBundle\Entity\User\GenderInterface;
use OW\CommunicationBundle\Entity\Vocative\Vocative;

class SalutationExtension extends \Twig_Extension
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * VocativeExtension constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('salutation', [$this, 'salutationFilter']),
        ];
    }

    /**
     * @param string $firstName
     * @return string
     */
    public function salutationFilter(string $firstName)
    {
        return sprintf('%s', $this->getSalutation($firstName));
    }

    /**
     * @param string $firstName
     * @return string
     */
    protected function getSalutation(string $firstName): string
    {
        /** @var Vocative $vocative */
        $vocative = $this->entityManager->getRepository(Vocative::class)->findOneBy(['name' => $firstName]);

        if (null === $vocative) {
            return "";
        }

        return $vocative->isMale() ? 'Drogi' : 'Droga';
    }
}
