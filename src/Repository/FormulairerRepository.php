<?php

namespace App\Repository;

use App\Entity\Formulairer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formulairer>
 *
 * @method Formulairer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulairer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulairer[]    findAll()
 * @method Formulairer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulairerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formulairer::class);
    }

    public function save(Formulairer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Formulairer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}