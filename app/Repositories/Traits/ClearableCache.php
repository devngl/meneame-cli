<?php declare(strict_types = 1);

namespace App\Repositories\Traits;

use Illuminate\Cache\Repository;
use Prettus\Repository\Helpers\CacheKeys;

trait ClearableCache
{
    public function clearCache()
    {
        $keys = CacheKeys::getKeys(static::class);

        /** @var Repository $cacheRepository */
        $cacheRepository = $this->getCacheRepository();
        foreach ($keys as $key) {
            $cacheRepository->forget($key);
        }
    }
}
