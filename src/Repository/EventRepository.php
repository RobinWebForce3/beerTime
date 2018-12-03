<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function search(?string $name, $sort)
    {
        $stmt = $this->createQueryBuilder('e');
        $stmt->andWhere('e.name LIKE :bind')
            ->setParameter(':bind', '%'. $name . '%');

        if ($sort == "price"){
            $stmt->orderBy('e.price', 'ASC');
        }elseif ($sort =="date") {
            $stmt->orderBy('e.createdAt', 'DESC');
        }

        return $stmt->getQuery()
            ->getResult();
    }

    public function countIncoming()
    {
        return $this->createQueryBuilder('e')
            ->select('count(e)')
            ->andWhere('e.startAt > :bind')
            ->setParameter(':bind', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
