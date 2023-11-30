<?php

namespace App\Repository;

use App\Entity\VideoGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoGallery>
 *
 * @method VideoGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoGallery[]    findAll()
 * @method VideoGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoGalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoGallery::class);
    }

//    /**
//     * @return VideoGallery[] Returns an array of VideoGallery objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VideoGallery
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
