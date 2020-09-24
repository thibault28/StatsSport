<?php

namespace App\Repository;

use App\Entity\MachineCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MachineCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MachineCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MachineCategory[]    findAll()
 * @method MachineCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MachineCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MachineCategory::class);
    }

    // /**
    //  * @return MachineCategory[] Returns an array of MachineCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MachineCategory
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
