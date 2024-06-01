<?php

namespace App\Tests\Functional;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\GpsCoordinateFixtures;
use App\Entity\GpsCoordinate;
use App\Kernel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

class GpsCoordinateApiTest extends ApiTestCase
{
    private EntityManagerInterface $entityManager;

    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    protected function setUp(): void
    {
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
        $this->loadFixtures([new GpsCoordinateFixtures()]);
    }

    private function loadFixtures(array $fixtures): void
    {
        $loader = new Loader();
        foreach ($fixtures as $fixture) {
            $loader->addFixture($fixture);
        }

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }

    public function testCreateGpsCoordinate()
    {
        $response = static::createClient()->request('POST', '/api/gps_coordinates', [
            'json' => [
                'latitude' => '40.712776',
                'longitude' => '-74.005974',
                'gpsTime' => '2023-06-01T00:00:00+00:00',
                'satellitesNo' => 5,
                'altitude' => 100,
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
                                      'latitude' => '40.712776',
                                      'longitude' => '-74.005974',
                                      'gpsTime' => '2023-06-01T00:00:00+00:00',
                                      'satellitesNo' => 5,
                                      'altitude' => 100,
                                  ]);
    }

    public function testGetGpsCoordinate()
    {
        $client = static::createClient();

        $iri = $this->findIriBy(GpsCoordinate::class, ['latitude' => '40.712776']);

        $client->request('GET', $iri);
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
                                      'latitude' => '40.712776',
                                      'longitude' => '-74.005974',
                                      'gpsTime' => '2023-06-01T00:00:00+00:00',
                                      'satellitesNo' => 5,
                                      'altitude' => 100,
                                  ]);
    }

    public function testUpdateGpsCoordinate()
    {
        $client = static::createClient();

        $iri = $this->findIriBy(GpsCoordinate::class, ['latitude' => '40.712776']);

        $client->request('PUT', $iri, [
            'json' => [
                'latitude' => '41.712776',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
                                      'latitude' => '41.712776',
                                  ]);
    }

    public function testDeleteGpsCoordinate()
    {
        $client = static::createClient();

        $iri = $this->findIriBy(GpsCoordinate::class, ['latitude' => '40.712776']);

        $client->request('DELETE', $iri);
        $this->assertResponseStatusCodeSame(204);

        $client->request('GET', $iri);
        $this->assertResponseStatusCodeSame(404);
    }
}
