<?php declare(strict_types = 1);

namespace App\Commands\Contracts;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\PostFetcher\PostsFetcher;
use App\Services\PostHydrator\PostHydrator;
use function Lambdish\Phunctional\each;
use function Lambdish\Phunctional\map;

trait PostsFetching
{
    /**
     * @var PostHydrator
     */
    protected $hydrator;

    /**
     * @var PostsFetcher
     */
    protected $fetcher;

    /**
     * @var PostRepository
     */
    protected $repository;

    private function fetchAndStoreNews(): void
    {
        each(function (Post $item): void {
            $this->repository->updateOrCreateByLinkId($item->toArray(), $item->link_id);
        }, map($this->hydrator, $this->fetcher->__invoke()));
    }
}
