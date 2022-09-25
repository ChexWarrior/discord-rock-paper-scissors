<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Handles creating, listing and removing the Discord commands for our App
 *
 * @package App\Controller
 */
class CommandCRUDController extends AbstractController
{
    #[Route('/commands/list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json([
            'message' => 'Allo govner!',
        ]);
    }
}
