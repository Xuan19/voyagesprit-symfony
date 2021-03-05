<?php

namespace App\Repository;

use App\Entity\Travel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Travel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Travel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Travel[]    findAll()
 * @method Travel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Travel::class);
    }


    public function getTravelsWithRelations()
    {
     $qb=$this->createQueryBuilder('t');

     $qb
        ->addSelect('d,c,cs')
        ->leftjoin('t.categories','c')
        ->leftjoin('t.dates','d')
        ->leftjoin('t.cities','cs')
        ->orderBy('d.startAt', 'DESC')

   ;

      return $qb->getQuery()->getResult();

    }


    public function getTravelWithRelations(int $id)
    {
     $qb=$this->createQueryBuilder('t');

     $qb
        ->addSelect('d,c,cs')
        ->leftjoin('t.categories','c')
        ->leftjoin('t.dates','d')
        ->leftjoin('t.cities','cs')
        ->orderBy('d.startAt', 'DESC')
        ->where('t.id= :id')
        ->setParameter(':id',$id)

   ;

      return $qb->getQuery()->getResult();

    }




    // /**
    //  * @return Travel[] Returns an array of Travel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Travel
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
