<?php

namespace App\Repository;

use App\Entity\Machines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Machines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Machines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Machines[]    findAll()
 * @method Machines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MachinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Machines::class);
    }

    // /**
    //  * @return Machines[] Returns an array of Machines objects
    //  */
    
    public function findAllOrderByMachineCategory()
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.machineCategory', 'category')
            ->orderBy('category.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Machines
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
