<?php

namespace App\Domain\Repository;

use App\Domain\Entity\FizzBuzz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FizzBuzz|null find($id, $lockMode = null, $lockVersion = null)
 * @method FizzBuzz|null findOneBy(array $criteria, array $orderBy = null)
 * @method FizzBuzz[]    findAll()
 * @method FizzBuzz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FizzBuzzRepository extends ServiceEntityRepository
{
    /**
     * FizzBuzzRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FizzBuzz::class);
        
    }

    /**
     * @param FizzBuzz $fizzBuzz
     * 
     * @return void
     */
    public function save(FizzBuzz $fizzBuzz): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($fizzBuzz);
        $entityManager->flush();

    }

    /**
     * @return string|null
     * 
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getLastFizzBuzzGenerated(): ?string
    {
        $fizzBuzz = $this->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $fizzBuzz ? $fizzBuzz->getFizzBuzzGenerated() : null;
        
    }
}
