<?php

namespace App\Repository;

use App\Entity\Story;
use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Story>
 *
 * @method Story|null find($id, $lockMode = null, $lockVersion = null)
 * @method Story|null findOneBy(array $criteria, array $orderBy = null)
 * @method Story[]    findAll()
 * @method Story[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Story::class);
    }

    public function add(Story $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Story $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//     SELECT * FROM `story` 
// INNER JOIN `page` 
// ON `page`.`story_id` = `story`.`id`
// WHERE `page`.`start` = 1

// public function findStartPage()
// {
//     $entityManager = $this->getEntityManager();

//     $qb = $entityManager->createQueryBuilder();

//     $qb->select('s', 'p.id')
//        ->from('App\Entity\Story','s')
//        ->join('App\Entity\Page', 'p', 'WITH', 'p.story = s.id')
//        ->where('p.start = true')
//        ->orderBy('s.title', 'ASC');

//     $query = $qb->getQuery();
//     $result = $query->getResult();


//     return $result;
// }

//    /**
//     * @return Story[] Returns an array of Story objects
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

//    public function findOneBySomeField($value): ?Story
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
