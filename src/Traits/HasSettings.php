<?php

namespace Metalc0der\Marketplace\Traits;

use Metalc0der\Marketplace\Models\Setting;

trait HasSettings
{
    public function settings()
    {
        return $this->morphToMany(Setting::class, 'seteable');
    }
}