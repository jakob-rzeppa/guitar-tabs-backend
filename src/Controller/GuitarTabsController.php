<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class GuitarTabsController extends AbstractController
{
    #[Route('/guitar/tabs', name: 'app_guitar_tabs_read_all', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GuitarTabsController.php',
        ]);
    }

    #[Route('/guitar/tabs/{id}', name: 'app_guitar_tab_read', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GuitarTabsController.php',
            'id' => $id,
        ]);
    }

    #[Route('/guitar/tabs', name: 'app_guitar_tabs_create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GuitarTabsController.php',
        ]);
    }

    #[Route('/guitar/tabs/{id}', name: 'app_guitar_tabs_update', methods: ['PUT'])]
    public function update(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GuitarTabsController.php',
            'id' => $id,
        ]);
    }

    #[Route('/guitar/tabs/{id}', name: 'app_guitar_tabs_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GuitarTabsController.php',
            'id' => $id,
        ]);
    }
}
