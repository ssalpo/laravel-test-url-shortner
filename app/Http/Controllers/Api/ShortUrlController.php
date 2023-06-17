<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Http\Resources\UrlShortResource;
use App\Models\ShortUrl;
use App\Services\ShortUrlService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShortUrlController extends Controller
{
    public function store(ShortUrlRequest $request, ShortUrlService $shortUrlService)
    {
        return UrlShortResource::make(
            $shortUrlService->store($request->validated())
        );
    }

    public function latest(): AnonymousResourceCollection
    {
        return UrlShortResource::collection(
            ShortUrl::latest()->take(10)->get()
        );
    }
}
