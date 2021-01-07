<?php

namespace Metalc0der\Marketplace\Facades;

use Metalc0der\Marketplace\MarketplaceManager;
use Illuminate\Support\Facades\Facade;

class Marketplace extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'marketplace';
    }
}