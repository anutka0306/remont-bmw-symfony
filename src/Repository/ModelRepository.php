<?php

namespace App\Repository;

use App\Entity\Model;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Model>
 *
 * @method Model|null find($id, $lockMode = null, $lockVersion = null)
 * @method Model|null findOneBy(array $criteria, array $orderBy = null)
 * @method Model[]    findAll()
 * @method Model[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Model::class);
    }

//    /**
//     * @return Model[] Returns an array of Model objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Model
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAllWithPath() {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT m, c.path 
            FROM App\Entity\Model m 
            JOIN App\Entity\Content c
            WHERE m.id = c.model'
        );
        return $query->getResult();
    }

    public function findAllWithPathForMenu() {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT m, c.path 
            FROM App\Entity\Model m 
            JOIN App\Entity\Content c
            WHERE m.id = c.model AND m.show_in_menu = 1 
            ORDER BY m.menu_order ASC'
        );
        return $query->getResult();
    }
}
