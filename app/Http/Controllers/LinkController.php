<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LinkController extends Controller
{
    private LinkService $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $link = $this->linkService->create($request->url);

        return response()->json([
            'code' => $link->code,
            'short_url' => url($link->code),
        ], 201);
    }

    public function redirect(string $code): RedirectResponse
    {
        $url = $this->linkService->redirect($code);

        if (!$url) {
            abort(404);
        }

        return redirect()->away($url, 302);
    }

    public function stats(string $code): JsonResponse
    {
        $link = $this->linkService->getStats($code);

        if (!$link) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'url' => $link->url,
            'code' => $link->code,
            'clicks' => $link->clicks,
            'created_at' => $link->created_at,
        ]);
    }
}
