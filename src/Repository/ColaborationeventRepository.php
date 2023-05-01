<?php

namespace App\Repository;

use App\Entity\Colaborationevent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Colaborationevent>
 *
 * @method Colaborationevent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colaborationevent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colaborationevent[]    findAll()
 * @method Colaborationevent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColaborationeventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colaborationevent::class);
    }

    public function save(Colaborationevent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Colaborationevent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findAllSortedByName($sort = 'asc')
    {
        $queryBuilder = $this->createQueryBuilder('e')
            ->orderBy('e.nomevent', $sort);
    
        return $queryBuilder->getQuery()->getResult();
    }

}