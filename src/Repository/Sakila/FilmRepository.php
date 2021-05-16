<?php

namespace App\Repository\Sakila;

use App\Entity\Sakila\Film;
use Doctrine\ORM\EntityRepository;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends EntityRepository
{
     /**
      * @return Film[] Returns an array of Film objects
      */
    public function findByExampleField()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.releaseYear = :val')
            ->setParameter('val', 2006)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
