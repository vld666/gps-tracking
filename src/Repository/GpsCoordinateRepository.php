<?php

namespace App\Repository;

use App\Entity\GpsCoordinate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GpsCoordinate>
 *
 * @method GpsCoordinate|null find($id, $lockMode = null, $lockVersion = null)
 * @method GpsCoordinate|null findOneBy(array $criteria, array $orderBy = null)
 * @method GpsCoordinate[]    findAll()
 * @method GpsCoordinate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GpsCoordinateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GpsCoordinate::class);
    }
}
