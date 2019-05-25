<?php declare(strict_types = 1);

namespace App\Providers;

use App\Commands\FetchFrontPageNews;
use App\Commands\FetchQueuedNews;
use App\Services\PostFetcher\MeneameRssFetcher;
use App\Services\PostFetcher\PostsFetcher;
use App\Services\PostHydrator\EloquentModelHydrator;
use App\Services\PostHydrator\PostHydrator;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostHydrator::class, EloquentModelHydrator::class);

        $this->handleFrontPageFetchingDependencies();
        $this->handleQueuedFetchingDependencies();
    }

    private function handleFrontPageFetchingDependencies(): void
    {
        $this->app
            ->when(FetchFrontPageNews::class)
            ->needs(PostsFetcher::class)
            ->give(static function () {
                return new MeneameRssFetcher((string) config('meneame.front_page_posts_rss_url'));
            });
    }

    private function handleQueuedFetchingDependencies(): void
    {
        $this->app
            ->when(FetchQueuedNews::class)
            ->needs(PostsFetcher::class)
            ->give(static function () {
                return new MeneameRssFetcher((string) config('meneame.queued_posts_rss_url'));
            });
    }
}
