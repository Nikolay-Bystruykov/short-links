<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    public function create(string $url): Link
    {
        $existing = Link::where('url', $url)->first();

        if ($existing) {
            return $existing;
        }

        $code = $this->generateUniqueCode();

        return Link::create([
            'url' => $url,
            'code' => $code,
            'clicks' => 0,
        ]);
    }

    public function redirect(string $code): ?string
    {
        $link = Link::where('code', $code)->first();

        if (!$link) {
            return null;
        }

        $link->increment('clicks');

        return $link->url;
    }

    public function getStats(string $code): ?Link
    {
        return Link::where('code', $code)->first();
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = Str::random(6);
        } while (Link::where('code', $code)->exists());

        return $code;
    }
}
