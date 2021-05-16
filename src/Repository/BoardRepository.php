<?php

namespace App\Repository;

use App\Entity\Board;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Board|null find($id, $lockMode = null, $lockVersion = null)
 * @method Board|null findOneBy(array $criteria, array $orderBy = null)
 * @method Board[]    findAll()
 * @method Board[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Board::class);
    }

    /**
    * @return Board
    */
    public function findByName($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.name = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByJoin($value): array
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.tasks', 't')
            ->andWhere('b.name = :val')
            ->setParameter('val', $value)
            ->select('b.name as board_name', 't.name as task_name')
            ->getQuery()
            ->getResult()
        ;
    }

}
