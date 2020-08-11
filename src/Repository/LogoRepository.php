<?php

namespace App\Repository;

use App\Entity\Logo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Logo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logo[]    findAll()
 * @method Logo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logo::class);
    }

    // /**
    //  * @return Logo[] Returns an array of Logo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findLogosByClub($id,$search)
    {
        $qb = $this->createQueryBuilder('l');
         $qb->join('l.club', 'c')
            ->where('c.id = :val')
            ->setParameter('val', $id);
             if($search){
                 if($search->getDateDebut()){
                     $qb->andWhere('l.createdAt >= :datedebut')
                         ->setParameter('datedebut', $search->getDateDebut())
                     ;
                 }

                 if($search->getDateFin()){
                     $qb->andWhere('l.createdAt <= :datefin')
                         ->setParameter('datefin', $search->getDateFin())
                     ;
                 }
             }
            return $qb->orderBy('l.createdAt', 'DESC')
                ->getQuery()
                ->getResult();
    }

    public function findAllLogos($search)
    {
        $qb = $this->createQueryBuilder('l');
        if($search){
            if($search->getDateDebut()){
                $qb->andWhere('l.createdAt >= :datedebut')
                    ->setParameter('datedebut', $search->getDateDebut())
                  ;
            }

            if($search->getDateFin()){
                $qb->andWhere('l.createdAt <= :datefin')
                    ->setParameter('datefin', $search->getDateFin())
                ;
            }
        }
        return $qb->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Logo
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}