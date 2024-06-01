<?php

namespace App\Tests;

use App\Factory\GpsCoordinateFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Kernel;

class GpsCoordinateTest extends KernelTestCase
{

    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    public function testSomething()
    {
        self::bootKernel();

        $gpsCoordinate = GpsCoordinateFactory::createOne();

        // Perform assertions
        $this->assertNotNull($gpsCoordinate->getId());
        $this->assertGreaterThanOrEqual(44.35, $gpsCoordinate->getLatitude());
        $this->assertLessThanOrEqual(44.55, $gpsCoordinate->getLatitude());
        $this->assertGreaterThanOrEqual(25.95, $gpsCoordinate->getLongitude());
        $this->assertLessThanOrEqual(26.15, $gpsCoordinate->getLongitude());
    }
}
