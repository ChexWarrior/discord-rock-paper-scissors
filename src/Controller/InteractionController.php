<?php declare(strict_types=1);

namespace App\Controller;

use App\Enum\InteractionCallbackType;
use App\Enum\InteractionType;
use App\Service\InteractionAuthorizer;
use App\Service\InteractionRequestConverter;
use App\Service\InteractionResponseGenerator;
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

        // TODO: Create classes and structures for Component Messages
        $componentData = [
            [
                'type' => 1,
                'components' => [
                    [
                        'type' => 2,
                        'label' => '🪨',
                        'style' => 1,
                        'custom_id' => 'rock_choice',
                    ],
                    [
                        'type' => 2,
                        'label' => '✂️',
                        'style' => 1,
                        'custom_id' => 'scissors_choice',
                    ],
                    [
                        'type' => 2,
                        'label' => '🗞️',
                        'style' => 1,
                        'custom_id' => 'paper_choice',
                    ]
                ]
            ]
        ];

        // TODO: Create service to handle the different interactions from game

        return InteractionResponseGenerator::generate(
            InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE,
            ['components' => $componentData, 'content' => 'Make your choice...'],
        );
    }
}
