<?php

namespace App\Services;

use App\Models\ShortUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShortUrlService
{
    public function store(array $data)
    {
        $data['url_key'] = $this->generateUrlFromLastId();

        return ShortUrl::create($data);
    }

    public function generateUrlFromLastId(): string
    {
        $lastShortUrl = ShortUrl::latest()->first()?->id ?? 0;

        return $this->generateUrlFromNumber($lastShortUrl + 1);
    }

    public function generateUrlFromNumber($num): string
    {
        $letter = chr(97 + (($num - 1) % 26));
        $nextNum = (int)(($num - 1) / 26);

        return $nextNum > 0
            ? $this->generateUrlFromNumber($nextNum) . $letter
            : $letter;
    }
}
