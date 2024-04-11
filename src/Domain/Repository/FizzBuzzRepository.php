<?php

namespace App\Domain\Repository;

use App\Domain\Entity\FizzBuzz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FizzBuzzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FizzBuzz::class);
    }

    public function save(FizzBuzz $fizzBuzz): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($fizzBuzz);
        $entityManager->flush();
    }

    public function getLastFizzBuzzGenerated()
    {
        $fizzBuzz = $this->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $fizzBuzz ? $fizzBuzz->getFizzBuzzGenerated() : null;
    }
}
