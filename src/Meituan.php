<?php

declare(strict_types=1);

namespace Ydg\MeituanMediaSdk;

use Ydg\FoudationSdk\ServiceContainer;

/**
 * @property Cps\Client $cps
 */
class Meituan extends ServiceContainer
{
    protected $providers = [
        Cps\ServiceProvider::class,
    ];
}
