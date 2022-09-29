<?php

namespace App\Repository;

use App\Entity\Choice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Choice>
 *
 * @method Choice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Choice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Choice[]    findAll()
 * @method Choice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Choice::class);
    }

    public function add(Choice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Choice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findStoryId($id)
    {
        // SELECT `story`.`id` FROM `story` 
        // INNER JOIN `page` ON `page`.`story_id` = `story`.`id`
        // INNER JOIN `choice` ON `choice`.`pages_id` = `page`.`id` 
        // WHERE `choice`.`id` = 95

    $entityManager = $this->getEntityManager();

    $qb = $entityManager->createQueryBuilder();

    $qb->select('s.id')
       ->from('App\Entity\Story','s')
       ->join('App\Entity\Page', 'p', 'WITH', 'p.story = s.id')
       ->join('App\Entity\Choice', 'c', 'WITH', 'c.pages = p.id')
       ->where('c.id = :id')
       ->setParameter(':id', $id);

    $query = $qb->getQuery();
    $result = $query->getSingleResult();
    


    return $result;
    }

//    /**
//     * @return Choice[] Returns an array of Choice objects
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

//    public function findOneBySomeField($value): ?Choice
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
