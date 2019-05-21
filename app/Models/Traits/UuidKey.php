<?php


namespace App\Models\Traits;


use Illuminate\Support\Str;

trait UuidKey
{
    public static function bootUuidKey()
    {
        static::creating(static function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}