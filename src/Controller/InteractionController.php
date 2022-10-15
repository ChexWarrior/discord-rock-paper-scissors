<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\InteractionAuthorizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InteractionController extends AbstractController
{
    #[Route('/interactions', methods: ['POST'])]
    public function interactionHandler(InteractionAuthorizer $interactionAuthorizer, Request $request): JsonResponse
    {
        $signature = $request->headers->get('');
        $timestamp = $request->headers->get('');
        $body = $request->getContent();

        if (!$interactionAuthorizer->verify($signature, $timestamp, $body)) {
            return new Response(status: 401);
        }

        
    }
}
