<?php

namespace App\Tests\Functional;

use App\Entity\GpsCoordinate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

class GpsCoordinateFunctionalTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Create the database schema
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->updateSchema($metadata);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }

    public function testGpsCoordinateLifecycle(): void
    {
        $dateTime = (new \DateTime('now'))->format('Y-m-d H:i:s');
        // Create a new GpsCoordinate entity
        $gpsCoordinate = new GpsCoordinate();
        $gpsCoordinate->setLatitude('45.12345678');
        $gpsCoordinate->setLongitude('90.12345678');
        $gpsCoordinate->setGpsTime(new \DateTime('now'));
        $gpsCoordinate->setSatellitesNo(8);
        $gpsCoordinate->setAltitude(1234);

        // Persist the entity
        $this->entityManager->persist($gpsCoordinate);
        $this->entityManager->flush();

        // Fetch the entity
        $savedGpsCoordinate = $this->entityManager
            ->getRepository(GpsCoordinate::class)
            ->find($gpsCoordinate->getId());

        // Assert the entity was saved correctly
        $this->assertInstanceOf(GpsCoordinate::class, $savedGpsCoordinate);
        $this->assertEquals('45.12345678', $savedGpsCoordinate->getLatitude());
        $this->assertEquals('90.12345678', $savedGpsCoordinate->getLongitude());
        $this->assertEquals($dateTime, $savedGpsCoordinate->getGpsTime()->format('Y-m-d H:i:s'));
        $this->assertEquals(8, $savedGpsCoordinate->getSatellitesNo());
        $this->assertEquals(1234, $savedGpsCoordinate->getAltitude());

        // Update the entity
        $savedGpsCoordinate->setLatitude('46.12345678');
        $this->entityManager->flush();

        // Fetch the updated entity
        $updatedGpsCoordinate = $this->entityManager
            ->getRepository(GpsCoordinate::class)
            ->find($savedGpsCoordinate->getId());

        // Assert the entity was updated correctly
        $this->assertEquals('46.12345678', $updatedGpsCoordinate->getLatitude());

        // Remove the entity
        $this->entityManager->remove($updatedGpsCoordinate);
        $this->entityManager->flush();

        $this->assertNull($updatedGpsCoordinate->getId());
    }
}
