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
    private ?\DateTimeInterface $gps_time = null;

    #[ORM\Column]
    private ?int $satellites_no = null;

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
        return $this->gps_time;
    }

    public function setGpsTime(\DateTimeInterface $gps_time): static
    {
        $this->gps_time = $gps_time;

        return $this;
    }

    public function getSatellitesNo(): ?int
    {
        return $this->satellites_no;
    }

    public function setSatellitesNo(int $satellites_no): static
    {
        $this->satellites_no = $satellites_no;

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
