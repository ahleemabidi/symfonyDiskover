<?php

namespace App\Repository;

use App\Entity\Facturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Facturer>
 *
 * @method Facturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facturer[]    findAll()
 * @method Facturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facturer::class);
    }

    public function save(Facturer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Facturer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }




    
    public function findUser($valueemail,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Facturer r   where r.statut like :statutt order by r.id_facture DESC '
            );
            $query->setParameter('statutt', $valueemail . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Facturer r   where r.statut like :statutt  order by r.id_facture ASC '
            );
            $query->setParameter('statutt', $valueemail . '%');
        }
        return $query->getResult();
    }














//    /**
//     * @return Facturer[] Returns an array of Facturer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Facturer
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
