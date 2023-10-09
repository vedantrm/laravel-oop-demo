<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait to generate UUIDs for models and get data with UUIDs
 * @method boot
 */
Trait Uuids 
{
    /**
     * @uses boot function from Laravel to generate UUIDs
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->uuid = Str::orderedUuid());
    }
}