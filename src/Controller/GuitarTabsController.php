<?php

namespace App\Controller;

use App\Entity\GuitarTab;
use App\Repository\GuitarTabRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GuitarTabsController extends AbstractController
{
    #[Route('/guitar_tabs', name: 'app_guitar_tabs_read_all', methods: ['GET'])]
    public function readAll(GuitarTabRepository $guitarTabRepository): JsonResponse
    {
        $guitarTabs = $guitarTabRepository->findAll();

        return $this->json([
            'data' => array_map(fn($guitarTab) => [
                'id' => $guitarTab->getId(),
                'name' => $guitarTab->getName(),
                'artist' => $guitarTab->getArtist(),
                'uploaded_at' => $guitarTab->getUploadedAt(),
            ], $guitarTabs),
        ]);
    }

    #[Route('/guitar_tabs/{id}', name: 'app_guitar_tab_read', methods: ['GET'])]
    public function read(int $id, GuitarTabRepository $guitarTabRepository): JsonResponse
    {
        $guitarTab = $guitarTabRepository->find($id);

        return $this->json([
            'id' => $guitarTab->getId(),
            'name' => $guitarTab->getName(),
            'artist' => $guitarTab->getArtist(),
            'capo' => $guitarTab->getCapo(),
            'uploaded_at' => $guitarTab->getUploadedAt(),
            'content' => $guitarTab->getContent(),
        ]);
    }

    #[Route('/guitar_tabs', name: 'app_guitar_tabs_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $body = $request->toArray();

        $guitarTab = new GuitarTab();
        $guitarTab->setName($body['name']);
        $guitarTab->setArtist($body['artist']);
        $guitarTab->setCapo($body['capo']);
        $guitarTab->setUploadedAt(new \DateTimeImmutable());
        $guitarTab->setContent($body['content']);

        $entityManagerInterface->persist($guitarTab);
        $entityManagerInterface->flush();

        return $this->json([
            'id' => $guitarTab->getId(),
        ], 201);
    }

    #[Route('/guitar_tabs/{id}', name: 'app_guitar_tabs_update', methods: ['PUT'])]
    public function update(int $id, Request $request, GuitarTabRepository $guitarTabRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $body = $request->toArray();

        $guitarTab = $guitarTabRepository->find($id);

        if (!$guitarTab) {
            return new JsonResponse(['error' => 'Guitar tab not found'], 404);
        }

        $guitarTab->setName($body['name'] ?? $guitarTab->getName());
        $guitarTab->setArtist($body['artist'] ?? $guitarTab->getArtist());
        $guitarTab->setCapo($body['capo'] ?? $guitarTab->getCapo());
        $guitarTab->setContent($body['content'] ?? $guitarTab->getContent());
        $entityManagerInterface->persist($guitarTab);

        $entityManagerInterface->flush();

        return new Response('', 204);
    }

    #[Route('/guitar_tabs/{id}', name: 'app_guitar_tabs_delete', methods: ['DELETE'])]
    public function delete(int $id, GuitarTabRepository $guitarTabRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $guitarTab = $guitarTabRepository->find($id);

        if (!$guitarTab) {
            return new JsonResponse(['error' => 'Guitar tab not found'], 404);
        }

        $entityManagerInterface->remove($guitarTab);
        $entityManagerInterface->flush();

        return new Response('', 204);
    }
}
