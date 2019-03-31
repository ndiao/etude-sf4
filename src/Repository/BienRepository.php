<?php

namespace App\Repository;

use App\Entity\Bien;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;

use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    /**
     * @return Bien[]
     */
    public function findAllEnVente(): array {
        return $this->findEnVenteQuery()
            ->getQuery()
            ->getResult();
    }
    
    /**
     * @return Bien[]
     */
    public function findLatest(): array {
        return $this->findEnVenteQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findEnVenteQuery(): QueryBuilder {
        return $this->createQueryBuilder('b')
            ->where('b.vendu = false');
    }

    // /**
    //  * @return Bien[] Returns an array of Bien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
