<?php

namespace App\Repository;

use App\Entity\Statistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistic[]    findAll()
 * @method Statistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistic::class);
    }

    // /**
    //  * @return Statistic[] Returns an array of Statistic objects
    //  */
    
    public function getStatistic($user,$machine)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.user', 'user')
            ->leftJoin('s.machine', 'machine')
            ->andWhere('user.id = :user')
            ->andWhere('machine.id = :machine')
            ->setParameter('user', $user)
            ->setParameter('machine', $machine)
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Statistic
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
