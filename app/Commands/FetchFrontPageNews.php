<?php declare(strict_types = 1);

namespace App\Commands;

use App\Commands\Contracts\PostsFetching;
use App\Repositories\PostRepository;
use App\Services\PostFetcher\PostsFetcher;
use App\Services\PostHydrator\PostHydrator;
use LaravelZero\Framework\Commands\Command;

final class FetchFrontPageNews extends Command
{
    use PostsFetching;

    public const FETCH_FRONT_PAGE_NEWS_COMMAND = 'news:fetch:front-page';

    /** @var string */
    protected $signature = self::FETCH_FRONT_PAGE_NEWS_COMMAND;

    /** @var string */
    protected $description = 'Este comando se encarga de obtener las noticias de portada y almacenarlas en BD';

    public function __construct(
        PostHydrator $hydrator,
        PostsFetcher $fetcher,
        PostRepository $repository
    ) {
        $this->hydrator = $hydrator;
        $this->fetcher = $fetcher;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Obtener las noticias y almacenarlas en la base de datos
     */
    public function handle(): void
    {
        $this->fetchAndStoreNews();
    }
}
