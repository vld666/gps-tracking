<?php

namespace App\DataFixtures;

use App\Entity\GpsCoordinate;
use App\Factory\GpsCoordinateFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GpsCoordinateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        GpsCoordinateFactory::createMany(10);  // Creates 10 entities with coordinates in Bucharest

        $manager->flush();
    }
}
