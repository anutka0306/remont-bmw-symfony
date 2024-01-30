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

    public function getSubmodelsByModelId($id) {
        return $this->findBy(['parent_id' => $id, 'page_type' => 'submodel']);
    }

    public function getAllWorks($limit = null) {
        $works_parents = $this->findBy(['parent_id' => 62, 'published' => 1, 'page_type' => 'works']);
        $works_parents_ids = array();
        foreach ($works_parents as $key => $value) {
            $works_parents_ids[] = $value->getId();
        }
        return $this->findBy(['parent_id' => $works_parents_ids, 'published' => 1], ['created_at' => 'DESC'], $limit);
    }

    public function getWorksByModel($id, $limit = null) {
        $works_parent = $this->findBy(['parent_id' => 62, 'published' => 1, 'page_type' => 'works', 'model' => $id], ['created_at' => 'DESC']);
        if (!empty($works_parent)) {
            return $this->findBy(['parent_id' => $works_parent[0]->getID(), 'published' => 1], ['created_at' => 'DESC'], $limit);
        } else {
            return null;
        }
    }

    public function getSubmodelServices() {
       return $this->findBy(['id' => Content::SUBMODEL_SERVICES]);
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
