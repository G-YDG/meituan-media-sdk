<?php

declare(strict_types=1);

namespace Ydg\MeituanMediaSdk\Support;

use Psr\Http\Message\ResponseInterface;

class Utils
{
    public static function jsonResponseToArray(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
