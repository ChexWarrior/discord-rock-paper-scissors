<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\AppCommand;
use App\Service\AppCommandApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Handles creating, listing and removing the Discord commands for our App
 *
 * @package App\Controller
 */
class AppCommandController extends AbstractController
{
    #[Route('/commands/list', methods: ['GET'])]
    public function list(AppCommandApi $commandApi): JsonResponse
    {
        $commandJSON = array_map(
            fn(AppCommand $c) => $c->toArray(),
            $commandApi->listCommands()
        );

        return $this->json($commandJSON);
    }
}
