<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\InteractionRequest;
use App\Enum\InteractionType;
use App\Service\InteractionAuthorizer;
use App\Service\InteractionRequestConverter;
use App\Service\PingPong;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InteractionController extends AbstractController
{
    #[Route('/interactions', methods: ['POST'])]
    public function interactionHandler(InteractionAuthorizer $interactionAuthorizer, PingPong $pingPong,Request $request, InteractionRequestConverter $interactionConverter): Response
    {
        $signature = $request->headers->get('X-Signature-Ed25519');
        $timestamp = $request->headers->get('X-Signature-Timestamp');
        $rawBody = $request->getContent();

        if (!$interactionAuthorizer->verify($signature, $timestamp, $rawBody)) {
            return new Response(status: 401);
        }

        $body = json_decode($rawBody, true);
        $interaction = $interactionConverter::convert($body);
        if ($interaction->type === InteractionType::PING) {
            return $pingPong->pong();
        }

        // Actual interaction response
        return new Response(
            json_encode(['type' => 4, 'data' => ['content' => 'Hello World!']]),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
