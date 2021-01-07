<?php

namespace Metalc0der\Marketplace\Traits;

use Illuminate\Support\Str;
use \Illuminate\Database\Eloquent\Relations\Pivot;

trait GenerateUuidAsPrimary
{
    /**
     * bootGenerateUuidAsPrimary
     *
     * @return void
     * @todo documentation
     */
    protected static function bootGenerateUuidAsPrimary(): void
    {
        static::creating(function ($model) {
            if ($model->getKey() && !is_a($model, Pivot::class)) {
                throw new \Exception("Can't set a primary key using UUID Trait", 1);
            }

            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::orderedUuid()->toString();
            }
        });
    }

    /**
     * getIncrementing
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * getKeyType
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}