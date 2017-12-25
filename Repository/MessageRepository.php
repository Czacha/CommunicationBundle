<?php

namespace OW\CommunicationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MessageEntityRepository
 * 
 * @package OW\CommunicationBundle\Repository
 */
class MessageRepository extends EntityRepository
{
    /**
     * @param string $messageClass
     * @param int $limit
     * @param int $maxErrorCount
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getMessagesToSentQB(string $messageClass, $limit = 10, int $maxErrorCount = 3)
    {
        return $this->createQueryBuilder('m')
            ->where('m.sentAt IS NULL')
            ->andWhere('m INSTANCE OF :class')
            ->andWhere('m.errorCount < :maxError')
            ->setParameter('maxError', $maxErrorCount)
            ->setParameter('class', $this->getEntityManager()->getClassMetadata($messageClass))
            ->orderBy('m.createdAt', 'ASC')
            ->setMaxResults($limit);
    }
}