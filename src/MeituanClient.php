<?php

declare(strict_types=1);

namespace Ydg\MeituanMediaSdk;

use Ydg\FoudationSdk\FoundationApi;
use Ydg\FoudationSdk\Traits\HasAttributes;
use Ydg\MeituanMediaSdk\Support\Utils;

class MeituanClient extends FoundationApi
{
    use HasAttributes;

    public function __construct(array $attributes)
    {
        if (!isset($attributes['base_uri'])) {
            $attributes['base_uri'] = 'https://media.meituan.com';
        }
        $this->attributes = $attributes;
    }

    public function post($uri, $body): ?array
    {
        $config = $this->toArray();

        $headers = $this->makeHeaders($config['app_key'], $body);

        $headers['S-Ca-Signature'] = $this->makeSign($this->makeSignString('POST', $uri, $headers), $config['app_secret']);

        $response = $this->getHttpClient()->request('POST', $config['base_uri'] . $uri, [
            'headers' => $headers,
            'body' => json_encode($body),
        ]);

        return Utils::jsonResponseToArray($response);
    }

    protected function makeHeaders($app_key, $body): array
    {
        return [
            'Accept' => 'application/json',
            'Content-MD5' => $this->makeContentMd5($body),
            'Content-Type' => 'application/json; charset=UTF-8',
            'S-Ca-App' => $app_key,
            'S-Ca-Timestamp' => intval(microtime(true) * 1000),
            'S-Ca-Signature-Headers' => 'S-Ca-Timestamp,S-Ca-App',
        ];
    }

    protected function makeContentMd5($body): string
    {
        return empty($body) ? '' : base64_encode(md5(json_encode($body), true));
    }

    protected function makeSign($signString, $app_secret): string
    {
        return base64_encode(hex2bin(hash_hmac('sha256', $signString, $app_secret)));
    }

    protected function makeSignString($method, $uri, $headers): string
    {
        return join("\n", [
            $method,
            $headers['Content-MD5'],
            "S-Ca-App:{$headers['S-Ca-App']}\nS-Ca-Timestamp:{$headers['S-Ca-Timestamp']}",
            $uri
        ]);
    }

    public function getHttpClientDefaultOptions(): array
    {
        return [
            'verify' => false,
        ];
    }
}
