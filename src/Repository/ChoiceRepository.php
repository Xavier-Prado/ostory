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

    public function findAllChoicesInformation()
    {
        // SELECT `choice`.*, `story`.`title` FROM `choice`
        // LEFT JOIN `page`
        // ON `page`.`id` = `choice`.`pages_id`
        // LEFT JOIN `story`
        // ON `story`.`id` = `page`.`story_id`

    $entityManager = $this->getEntityManager();

    $qb = $entityManager->createQueryBuilder();

    $qb->select('c, s.title, p.id')
       ->from('App\Entity\Choice','c')
       ->join('App\Entity\Page', 'p', 'WITH', 'p.id = c.pages')
       ->join('App\Entity\Story', 's', 'WITH', 's.id = p.story');

    //    $qb->select('s.title')
    //    ->from('App\Entity\Story','s')
    //    ->join('App\Entity\Page', 'p', 'WITH', 'p.story = s.id')
    //    ->join('App\Entity\Choice', 'c', 'WITH', 'c.pages = p.id')
    //    ->where('c.id = :id')
    //    ->setParameter(':id', $id);

    $query = $qb->getQuery();
    $result = $query->getArrayResult();
    


    return $result;
    }

    public function findChoiceInformation($id)
    {

    $entityManager = $this->getEntityManager();

    $qb = $entityManager->createQueryBuilder();

    $qb->select('s.title, c.id, c.name, c.description, c.page_to_redirect')
    ->from('App\Entity\Story','s')
    ->join('App\Entity\Page', 'p', 'WITH', 'p.story = s.id')
    ->join('App\Entity\Choice', 'c', 'WITH', 'c.pages = p.id')
    ->where('c.id = :id')
    ->setParameter(':id', $id);

    $query = $qb->getQuery();
    $result = $query->getResult();
    


    return $result;
    }
}
