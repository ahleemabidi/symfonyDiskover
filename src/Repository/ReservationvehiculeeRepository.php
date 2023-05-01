<?php

namespace App\Repository;

use App\Entity\Reservationvehiculee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservationvehiculee>
 *
 * @method Reservationvehiculee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservationvehiculee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservationvehiculee[]    findAll()
 * @method Reservationvehiculee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationvehiculeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservationvehiculee::class);
    }

    public function save(Reservationvehiculee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservationvehiculee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findOneBySomeField($value): ?Reservationvehiculee
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.idreservationv = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }}