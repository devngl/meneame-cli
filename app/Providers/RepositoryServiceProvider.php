<?php declare(strict_types = 1);

namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
    }
}
