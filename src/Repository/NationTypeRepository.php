<?php

namespace App\Repository;

use App\Entity\NationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NationType>
 *
 * @method NationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationType[]    findAll()
 * @method NationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NationType::class);
    }

    //    /**
    //     * @return NationType[] Returns an array of NationType objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?NationType
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
