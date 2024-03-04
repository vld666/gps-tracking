<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GpsCoordinateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GpsCoordinateRepository::class)]
#[ApiResource]
class GpsCoordinate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $longitude = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $gpsTime = null;

    #[ORM\Column]
    private ?int $satellitesNo = null;

    #[ORM\Column]
    private ?int $altitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getGpsTime(): ?\DateTimeInterface
    {
        return $this->gpsTime;
    }

    public function setGpsTime(\DateTimeInterface $gpsTime): static
    {
        $this->gpsTime = $gpsTime;

        return $this;
    }

    public function getSatellitesNo(): ?int
    {
        return $this->satellitesNo;
    }

    public function setSatellitesNo(int $satellitesNo): static
    {
        $this->satellitesNo = $satellitesNo;

        return $this;
    }

    public function getAltitude(): ?int
    {
        return $this->altitude;
    }

    public function setAltitude(int $altitude): static
    {
        $this->altitude = $altitude;

        return $this;
    }
}
