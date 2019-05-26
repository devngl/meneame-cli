<?php declare(strict_types = 1);

namespace App\Commands;

use App\Repositories\PostRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;

final class FetchNews extends Command
{
    public const FETCH_NEWS_COMMAND = 'news:fetch';

    /** @var string */
    protected $signature = self::FETCH_NEWS_COMMAND;

    /** @var string */
    protected $description = 'El comando descargará todas las noticias: encoladas y de portada.';

    /** @var PostRepository */
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->repository->cleanOrder();

        $this->task('Importando noticias de portada', function () {
            $this->call(FetchFrontPageNews::FETCH_FRONT_PAGE_NEWS_COMMAND);

            return true;
        });

        $this->task('Importando noticias de la cola', function () {
            $this->call(FetchQueuedNews::FETCH_QUEUED_NEWS_COMMAND);

            return true;
        });

        $this->repository->clearCache();

        $infoMessage = 'Todas las noticias han sido importadas a la base de datos.';

        Log::channel('news')->info($infoMessage);
        $this->info($infoMessage);
    }

    /**
     * Import news and store them in database every minute without overlapping
     *
     * @param  Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        $schedule->command(self::class)->everyMinute()->withoutOverlapping();
    }
}
