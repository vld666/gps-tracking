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
        $allCoordinates = $entityManager->getRepository(GpsCoordinate::class)->findAll();

        return $this->render('dashboard/index.html.twig', [
            'gpsCoordinates' => $allCoordinates,
        ]);
    }
}
