<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\RedirectResponse;

class ShortUrlController extends Controller
{
    public function open(string $key): RedirectResponse
    {
        $shortUrl = ShortUrl::whereUrlKey($key)->firstOrFail();

        return response()->redirectTo(
            $shortUrl->destination_url
        );
    }
}
