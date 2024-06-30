<?php

namespace App\Tests\Entity;

use App\Entity\GpsCoordinate;
use PHPUnit\Framework\TestCase;

class GpsCoordinateTest extends TestCase
{
    public function testGpsCoordinateEntity(): void
    {
        $gpsCoordinate = new GpsCoordinate();

        // Test setLatitude and getLatitude
        $latitude = '45.12345678';
        $gpsCoordinate->setLatitude($latitude);
        $this->assertEquals($latitude, $gpsCoordinate->getLatitude());

        // Test setLongitude and getLongitude
        $longitude = '90.12345678';
        $gpsCoordinate->setLongitude($longitude);
        $this->assertEquals($longitude, $gpsCoordinate->getLongitude());

        // Test setGpsTime and getGpsTime
        $gpsTime = new \DateTime('now');
        $gpsCoordinate->setGpsTime($gpsTime);
        $this->assertEquals($gpsTime, $gpsCoordinate->getGpsTime());

        // Test setSatellitesNo and getSatellitesNo
        $satellitesNo = 8;
        $gpsCoordinate->setSatellitesNo($satellitesNo);
        $this->assertEquals($satellitesNo, $gpsCoordinate->getSatellitesNo());

        // Test setAltitude and getAltitude
        $altitude = 1234;
        $gpsCoordinate->setAltitude($altitude);
        $this->assertEquals($altitude, $gpsCoordinate->getAltitude());
    }

    public function testLatitude() : void
    {
        $gpsCoordinate = new GpsCoordinate();
        $latitude = '45.12345678';

        $gpsCoordinate->setLatitude($latitude);
        $this->assertSame($latitude, $gpsCoordinate->getLatitude());
    }

    public function testLongitude() : void
    {
        $gpsCoordinate = new GpsCoordinate();
        $longitude = '90.12345678';

        $gpsCoordinate->setLongitude($longitude);
        $this->assertSame($longitude, $gpsCoordinate->getLongitude());
    }

    public function testGpsTime() : void
    {
        $gpsCoordinate = new GpsCoordinate();
        $gpsTime = new \DateTime('now');

        $gpsCoordinate->setGpsTime($gpsTime);
        $this->assertSame($gpsTime, $gpsCoordinate->getGpsTime());
    }

    public function testSatellitesNo() : void
    {
        $gpsCoordinate = new GpsCoordinate();
        $satellitesNo = 8;

        $gpsCoordinate->setSatellitesNo($satellitesNo);
        $this->assertSame($satellitesNo, $gpsCoordinate->getSatellitesNo());
    }

    public function testAltitude() : void
    {
        $gpsCoordinate = new GpsCoordinate();
        $altitude = 1234;

        $gpsCoordinate->setAltitude($altitude);
        $this->assertSame($altitude, $gpsCoordinate->getAltitude());
    }

    public function testNullValues() : void
    {
        $gpsCoordinate = new GpsCoordinate();

        $this->assertNull($gpsCoordinate->getLatitude());
        $this->assertNull($gpsCoordinate->getLongitude());
        $this->assertNull($gpsCoordinate->getGpsTime());
        $this->assertNull($gpsCoordinate->getSatellitesNo());
        $this->assertNull($gpsCoordinate->getAltitude());
    }

    public function testStringValuesForNumericFields() : void
    {
        $gpsCoordinate = new GpsCoordinate();

        $this->expectException(\TypeError::class);
        // @phpstan-ignore-next-line
        $gpsCoordinate->setSatellitesNo('eight');
    }

    public function testInvalidDateFormat() : void
    {
        $gpsCoordinate = new GpsCoordinate();

        $this->expectException(\TypeError::class);
        // @phpstan-ignore-next-line
        $gpsCoordinate->setGpsTime('invalid date format');
    }
}
