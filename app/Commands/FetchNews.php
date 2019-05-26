<?php declare(strict_types = 1);

namespace App\Commands;

use App\Repositories\PostRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;

final class FetchNews extends Command
{
    /** @var string  */
    protected $signature = 'news:fetch';

    /** @var string  */
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
            $this->call('news:fetch:front');

            return true;
        });

        $this->task('Importando noticias de la cola', function () {
            $this->call('news:fetch:queued');

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
