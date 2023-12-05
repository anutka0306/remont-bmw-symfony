<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Content>
 *
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function findOneByToken($token)
    {
        $token = trim($token,'/ ');
        if (empty($token)) {
            $path = '/';
        }else{
            $path = '/'.$token.'/';
        }
        return $this->findOneBy(['path'=>$path]);
    }

    public function findOnePublishedByToken($token)
    {
        $token = trim($token,'/ ');
        if (empty($token)) {
            $path = '/';
        }else{
            $path = '/'.$token.'/';
        }
        return $this->findOneBy(['path'=>$path,'published'=>true]);
    }

    public function findPageByPath($path)
    {
        $path = trim($path);
        if (empty($path)) {
            $path = 'index';
        }
        return $this->findOneBy(['path' => $path, 'published' => true]);
    }

    public function getHeaderMenu() {
        return $this->createQueryBuilder('c')
            ->andWhere('c.in_header_nav = 1')
            ->andWhere('c.published = 1')
            ->getQuery()
            ->getResult();
    }

    public function getFooterMenu() {
        return $this->createQueryBuilder('c')
            ->andWhere('c.in_footer_nav = 1')
            ->andWhere('c.published = 1')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Content[] Returns an array of Content objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Content
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
