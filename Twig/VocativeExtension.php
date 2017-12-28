<?php

namespace OW\CommunicationBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;
use OW\CommunicationBundle\Entity\User\GenderInterface;
use OW\CommunicationBundle\Entity\Vocative\Vocative;

class VocativeExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter('vocative', [$this, 'vocativeFilter']),
        ];
    }


    public function vocativeFilter(string $firstName)
    {
        return sprintf('%s', $this->getVocative($firstName));
    }

    /**
     * @param GenderInterface $user
     * @return string
     */
    protected function getVocative(string $firstName): string
    {
        /** @var Vocative $vocative */
        $vocative = $this->entityManager->getRepository(Vocative::class)->findOneBy(['name' => $firstName]);

        if (null === $vocative) {
            $this->createNewVocative($firstName);
            return $firstName;
        }

        return $vocative->getTranslation();
    }

    private function createNewVocative(string $firstName)
    {
        $vocative = new Vocative();
        $vocative->setName($firstName);
        $vocative->setTranslation($firstName);

        $this->entityManager->persist($vocative);
        $this->entityManager->flush();
    }
}
