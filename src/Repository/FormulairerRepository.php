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

    public function findformulairerbyType($type){
        return $this ->createQueryBuilder('formulairer')
          ->where('formualirer.type LIKE :type')
          ->setParameter('type', '%'.$type.'%')
          ->getQuery()
          ->getResult();
    }

    

    public function search($searchTerm)
    {
        $qb = $this->createQueryBuilder('f')
            ->where('form.type LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%');

        return $qb->getQuery()->getResult();
    }

    public function findAllSortedByName($sort = 'asc')
    {
        $queryBuilder = $this->createQueryBuilder('e')
            ->orderBy('e.type', $sort);
    
        return $queryBuilder->getQuery()->getResult();
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM AppBundle:Post p
                WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }







    public function find_Nb_hotel_Par_Etat($categ){

        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT DISTINCT  count(h.id) FROM   App\Entity\Formulairer h  where h.categ = :categ   '
        );
        $query->setParameter('categ', $categ);
        return $query->getResult();
    }







    
    public function findUser($valueemail,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Formulairer r   where r.nom like :nomm order by r.id DESC '
            );
            $query->setParameter('nomm', $valueemail . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Formulairer r   where r.nom like :nomm  order by r.id ASC '
            );
            $query->setParameter('nomm', $valueemail . '%');
        }
        return $query->getResult();
    }


}