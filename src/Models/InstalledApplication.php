<?php

namespace Metalc0der\Marketplace\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Metalc0der\Marketplace\Traits\GenerateUuidAsPrimary;

class InstalledApplication extends Model
{
    use HasFactory, GenerateUuidAsPrimary, SoftDeletes;

    protected $fillable = [
        'application_id',
        'active'
    ];
    protected static function newFactory()
    {
        return \Metalc0der\Marketplace\Database\Factories\InstalledApplicationFactory::new();
    }

}
