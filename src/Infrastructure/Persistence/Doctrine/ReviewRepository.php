<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Model\Review;
use App\Domain\Model\ReviewRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository implements ReviewRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * @return array
     */
    public function list(): array
    {
        // TODO: We could add some parameters in order to deal with pagination and filters.
        $qb = $this->getSearchQueryBuilder();
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Review $entity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Review $entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param Review $entity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Review $entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    protected function getSearchQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('rev');
        return $qb;
    }
}
