<?php

namespace Metalc0der\Marketplace\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Metalc0der\Marketplace\Traits\GenerateUuidAsPrimary;

class Setting extends Model
{
    use GenerateUuidAsPrimary, HasFactory;

    protected $fillable = [
        'key',
        'value',
        'application_id',
        'seteable_id',
        'seteable_type'
    ];

    public $timestamps = false;

    public function installed_application()
    {
        return $this->belongsTo(InstalledApplication::class);
    }

    public function seteable()
    {
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return \Metalc0der\Marketplace\Database\Factories\SettingFactory::new();
    }

}
