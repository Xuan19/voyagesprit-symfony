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
    
        public function getMainTravels()
        {
         $qb=$this->createQueryBuilder('t');
    
         $qb
            ->addSelect('d,c,cs')
            ->leftjoin('t.categories','c')
            ->leftjoin('t.dates','d')
            ->leftjoin('t.cities','cs')
            ->orderBy('d.startAt', 'DESC')
            ->where('t.display_homepage = 1')
    
       ;
    
          return $qb->getQuery()->getResult();
    
        }


    public function getTravels($startDate,$destination,$category)
    {
     $qb=$this->createQueryBuilder('t');

     $qb
        ->addSelect('d,c,cs,cts')
        ->leftjoin('t.categories','c')
        ->leftjoin('t.dates','d')
        ->leftjoin('t.cities','cs')
        ->leftjoin('cs.country','cts')
        ->orderBy('d.startAt', 'DESC')    
   ;
    if ($category) {
        $qb
        ->andHaving('c.name = :category')
        ->setParameter(':category',$category);
    }
    if ($destination){
        $qb->andHaving('cts.countryName = :destination')
        ->setParameter(':destination',$destination);
    }
    if ($startDate){
        $qb->andwhere('d.startAt >= :startDate')
        ->setParameter(':startDate',$startDate);
    }

      return $qb->getQuery()->getResult();   

    }


    public function getTravel(int $id)
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

      return $qb->getQuery()->getOneOrNullResult();

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
