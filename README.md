# meituan-media-sdk

media.meituan.com

Install the latest version with

```bash
$ composer require ydg/meituan-media-sdk"
```

```php
<?php

use Ydg\MeituanMediaSdk\Meituan;

$app = new Meituan([
    'app_key' => 'your app_key',
    'app_secret' => 'your app_secret',
]);
$app->cps->query_order([
    'queryTimeType' => 1,
    'startTime' => time() - 60,
    'endTime' => time(),
    'page' => 1,
    'limit' => 10,
]);
```
