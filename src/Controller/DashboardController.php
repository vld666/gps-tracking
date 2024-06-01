<?php

namespace App\Controller;

use App\Entity\GpsCoordinate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $allCoordinates = $entityManager->getRepository(GpsCoordinate::class)->findOneBy([], ['gpsTime' => 'DESC']);

        return $this->render('dashboard/index.html.twig', [
            'currentPosition' => $allCoordinates,
        ]);
    }

    #[Route('/history', name: 'histoy')]
    public function history(EntityManagerInterface $entityManager): Response
    {
        $allCoordinates = $entityManager->getRepository(GpsCoordinate::class)->findBy([], ['gpsTime' => 'DESC']);

        $createdCoordinates = [];
        foreach ($allCoordinates as $coordinate) {
            $createdCoordinates[] = [
                $coordinate->getLongitude(), $coordinate->getLatitude()
            ];
        }

        return $this->render('dashboard/history.html.twig', [
            'gpsCoordinates' => $allCoordinates,
            'jsonCoordinates' => json_encode($createdCoordinates),
            'currentPosition' => reset($allCoordinates),
        ]);
    }
}
