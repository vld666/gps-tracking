<?php

namespace App\Factory;

use App\Entity\GpsCoordinate;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<GpsCoordinate>
 */
final class GpsCoordinateFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'latitude' => self::faker()->latitude(44.35, 44.55),
            'longitude' => self::faker()->longitude(25.95, 26.15),
            'gpsTime' => self::faker()->dateTimeBetween('-1 year', 'now'),
            'satellitesNo' => self::faker()->numberBetween(4, 15),
            'altitude' => self::faker()->numberBetween(0, 150),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (GpsCoordinate $gpsCoordinate) {
                $gpsCoordinate->setLatitude((string) $gpsCoordinate->getLatitude());
                $gpsCoordinate->setLongitude((string) $gpsCoordinate->getLongitude());
            });
    }

    protected static function getClass(): string
    {
        return GpsCoordinate::class;
    }
}
