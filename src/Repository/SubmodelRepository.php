<?php

namespace App\Repository;

use App\Entity\Submodel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Submodel>
 *
 * @method Submodel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Submodel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Submodel[]    findAll()
 * @method Submodel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubmodelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Submodel::class);
    }

//    /**
//     * @return Submodel[] Returns an array of Submodel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Submodel
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findWithPathByBrand($brand_id) {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT s, c.path
            FROM App\Entity\Submodel s
            LEFT JOIN App\Entity\Content c 
          WITH s.id = c.submodel WHERE s.model_id = :val')
        ->setParameter('val', $brand_id);
        return $query->getResult();
    }
}
