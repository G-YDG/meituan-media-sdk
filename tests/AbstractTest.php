<?php

namespace YdgTest\MeituanMediaSdk;

use PHPUnit\Framework\TestCase;
use Ydg\MeituanMediaSdk\Meituan;

abstract class AbstractTest extends TestCase
{
    protected static $app;

    public function getApp(): Meituan
    {
        if (!(self::$app instanceof Meituan)) {
            self::$app = new Meituan($this->getConfig());
        }
        return self::$app;
    }

    public function getConfig(): array
    {
        return [
            'base_uri' => 'https://media.meituan.com',
            'app_key' => getenv('APP_KEY'),
            'app_secret' => getenv('APP_SECRET'),
        ];
    }
}
