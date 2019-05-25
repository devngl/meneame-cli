<?php declare(strict_types = 1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UuidKey
{
    public static function bootUuidKey(): void
    {
        static::creating(static function (Model $model): void {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
