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
        $commands = $commandApi->listCommands();
        $commandJSON = '';
        array_walk($commands, function (AppCommand $c) use (&$commandJSON) {
            $commandJSON .= $c->toJson();
        });

        return $this->json($commandJSON);
    }
}
