<?php

namespace App\Repository;

use App\Entity\Many;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Many>
 *
 * @method Many|null find($id, $lockMode = null, $lockVersion = null)
 * @method Many|null findOneBy(array $criteria, array $orderBy = null)
 * @method Many[]    findAll()
 * @method Many[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Many::class);
    }

    //    /**
    //     * @return Many[] Returns an array of Many objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Many
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
