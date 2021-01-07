<?php

namespace Metalc0der\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Metalc0der\Marketplace\Traits\GenerateUuidAsPrimary;

class Setting extends Model
{
    use GenerateUuidAsPrimary;

    protected $fillable = [
        'key',
        'value',
        'application_id'
    ];

    public function installed_application()
    {
        return $this->belongsTo(InstalledApplication::class);
    }
}
