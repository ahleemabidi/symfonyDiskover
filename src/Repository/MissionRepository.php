<?php

namespace App\Repository;
use DateTime;
use DateTimeZone;
use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mission>
 *
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        
        parent::__construct($registry, Mission::class);
        $this->entityManager = $entityManager;

    }

    public function save(Mission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findByDescriptionAndOrderByHeureDebut(string $description, string $order = 'ASC'): array
{
    $qb = $this->createQueryBuilder('m')
        ->where('m.description LIKE :description')
        ->setParameter('description', '%' . $description . '%')
        ->orderBy('m.heureDebut', $order);
    
    return $qb->getQuery()->getResult();
}
public function getDurationsByDate(): array
{
    $missions = $this->createQueryBuilder('m')
    ->select('m.heureDebut, m.heureFin, m.matricule')
    ->getQuery()
    ->getResult();

$dureesParDate = [];
$nbMissionsParDate = [];

foreach ($missions as $mission) {
    $heureDebut = $mission['heureDebut']->setTimezone(new DateTimeZone('UTC'));
    $heureFin = $mission['heureFin']->setTimezone(new DateTimeZone('UTC'));
    $date = $heureDebut->format('Y-m-d');
    $matricule = $mission['matricule'];

    if (!isset($dureesParDate[$date])) {
        $dureesParDate[$date] = [];
        $nbMissionsParDate[$date] = [];
    }

    if (!isset($dureesParDate[$date][$matricule])) {
        $dureesParDate[$date][$matricule] = 0;
        $nbMissionsParDate[$date][$matricule] = 0;
    }

    $dureesParDate[$date][$matricule] += $heureFin->getTimestamp() - $heureDebut->getTimestamp();
    $nbMissionsParDate[$date][$matricule]++;
}

$dureesMoyennesParDate = [];

foreach ($dureesParDate as $date => $durees) {
    foreach ($durees as $matricule => $duree) {
        $dureesMoyennesParDate[$date . ' - ' . $matricule] = $duree / $nbMissionsParDate[$date][$matricule];
    }
}

return $dureesMoyennesParDate;

}

public function countDistinctMissions(): int
{
    return $this->createQueryBuilder('m')
        ->select('COUNT(DISTINCT m.idMission)')
        ->getQuery()
        ->getSingleScalarResult();

}
public function findMinDuration(): ?int
{
    $qb = $this->createQueryBuilder('m');
    $qb->select('MIN(DATEDIFF( m.heureDebut, m.heureFin)) as min_duration');

    $result = $qb->getQuery()->getOneOrNullResult();
    return $result['min_duration'];
}
public function findMaxDuration(): ?int
{
    $qb = $this->createQueryBuilder('m');
    $qb->select('MAX(m.heureFin - m.heureDebut) as min_duration');

    $result = $qb->getQuery()->getOneOrNullResult();
    return $result['min_duration'];
}

public function findByDesc(): array
{
            return $this->createQueryBuilder('m')
            ->select('COUNT(m.idMission) as totalMissions')
            ->addSelect('SUM(CASE WHEN m.description = \'Inter-Urbain\' THEN 1 ELSE 0 END) as interurbainMissions')
            ->addSelect('SUM(CASE WHEN m.description = \'Intra-Urbain\' THEN 1 ELSE 0 END) as intraurbainMissions')
            ->getQuery()
            ->getResult();
}
public function findBymission($description){

    $em = $this->getEntityManager();

    $query = $em->createQuery(
        'SELECT DISTINCT  count(m.idMission) FROM   App\Entity\Mission m  where m.description = :description   '
    );
    $query->setParameter('description', $description);
    return $query->getResult();
}
public function FindMissionByDesc($description)
    {
                return $this->createQueryBuilder('m')
                            ->where('m.description LIKE :description')
                            ->setParameter('description', '%'.$description.'%')
                            ->getQuery()
                            ->getResult();
    }
    public function findAllSortedByheure($sort = 'asc')
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->orderBy('m.heureDebut', $sort)
            ->addOrderBy('m.heureFin', $sort);

    
        return $queryBuilder->getQuery()->getResult();
    }
// public function getAverageDuration(DateTime $start, DateTime $end): int
// {
//     $interval = $start->diff($end);
//     $duration = $interval->format('%i');
//     return $duration;
// }
// public function getStats(): array
// {
//     $stats = $this->entityManager->createQueryBuilder('m')
//     ->select('m.matricule', 'COUNT(m.id) as nbMissions', 'AVG((m.heureFin->getTimestamp() - m.heureDebut->getTimestamp()) / 60) as dureeMoyenne')
//     ->groupBy('m.matricule')
//         ->getQuery()
//         ->getResult();
//         foreach ($stats as &$stat) {
//             $stat['dureeMoyenne'] = (float) $stat['dureeMoyenne'];
//         }
//     return $stats;
// }
// public function findDistinctMatricules(): array
//     {
//         $qb = $this->createQueryBuilder('m')
//             ->select('DISTINCT  m.matricule')
//             ->groupBy('m.matricule')
//             ->getQuery();

//         return $qb->getResult();
//     }

//     public function getStatsDureeMoyenneMission(string $matricule): array
//     {
//         $queryBuilder = $this->createQueryBuilder('m');
//         $queryBuilder->select('AVG(TIME_TO_SEC(TIMEDIFF(m.heureFin, m.heureDebut))) AS duree_moy')
//             ->addSelect('COUNT(m.id) AS total_missions')
//             ->addSelect('MAX(TIME_TO_SEC(TIMEDIFF(m.heureFin, m.heureDebut))) AS duree_max')
//             ->addSelect('MIN(TIME_TO_SEC(TIMEDIFF(m.heureFin, m.heureDebut))) AS duree_min')
//             ->where('m.matricule = :matricule')
//             ->setParameter('matricule', $matricule);
    
//         $result = $queryBuilder->getQuery()->getSingleResult();
    
//         return [
//             'duree_moyenne' => (int) $result['duree_moy'],
//             'total_missions' => (int) $result['total_missions'],
//             'duree_max' => (int) $result['duree_max'],
//             'duree_min' => (int) $result['duree_min'],
//         ];
//     }

//    /**
//     * @return Mission[] Returns an array of Mission objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mission
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
