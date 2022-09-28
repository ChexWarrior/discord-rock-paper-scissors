<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\AppCommand;
use App\DTO\AppCommandOption;
use App\DTO\AppCommandOptionChoice;
use App\Enum\AppCommandOptionType;
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

    #[Route('/commands/delete/{id}', methods: ['DELETE'])]
    public function delete(AppCommandApi $commandApi, string $id): JsonResponse
    {
        $success = $commandApi->deleteCommand($id);

        return $this->json($success);
    }

    #[Route('/commands/create/{appId}', methods: ['POST'])]
    public function create(AppCommandApi $commandApi, string $appId): JsonResponse {
        // Statically create RPS command
        $choices = [
            new AppCommandOptionChoice('Rock', 'rock'),
            new AppCommandOptionChoice('Paper', 'paper'),
            new AppCommandOptionChoice('Scissors', 'scissors'),
        ];
        $commandOption = new AppCommandOption(AppCommandOptionType::STRING, 'choice', 'The RPS choice made by player', true, $choices);
        $rpsCommand = new AppCommand(null, $appId, 'rps', 'Rock Paper Scissors!', [$commandOption]);
        $success = $commandApi->createCommand($rpsCommand);

        return $this->json($success);
    }
}
