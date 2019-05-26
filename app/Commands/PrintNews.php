<?php declare(strict_types = 1);

namespace App\Commands;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Collection;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Helper\TableSeparator;

final class PrintNews extends Command
{
    public const PRINT_NEWS_COMMAND = 'news:show';

    /** @var string */
    protected $signature = self::PRINT_NEWS_COMMAND . '
                           {limit=20 : Cantidad de noticias máxima a mostrar}
                           {status?  : Estado de la noticia}';

    /** @var string */
    protected $description = 'Muestra las noticias más actuales';

    /**
     * @param  PostRepository  $repository
     */
    public function handle(PostRepository $repository)
    {
        $status = $this->getRequestedStatus();
        $limit = (int) $this->argument('limit');

        $posts = $repository->getPostsByStatus($status, $limit);

        if (!count($posts)) {
            $this->info('No hay ninguna noticia en nuestra base de datos.');
        }

        $this->printPosts($posts);
    }

    /**
     * @param  Collection  $posts
     * @return void
     */
    private function printPosts($posts): void
    {
        $headers = array_keys(self::columnPairs());
        $headerSpan = count($headers);

        $splitPosts = $this->addTableSeparators($posts, $headerSpan);

        $this->table($headers, $splitPosts, 'box-double');
    }

    public static function columnPairs(): array
    {
        return [
            'Título'      => 'title',
            'Votos'       => 'votes',
            'Karma'       => 'karma',
            'Comentarios' => 'comments',
        ];
    }

    /**
     * @param  Collection  $posts
     * @param  int  $headerSpan
     * @return array
     */
    private function addTableSeparators($posts, int $headerSpan): array
    {
        $splitPosts = [];
        /** @var Post $post */
        foreach ($posts as $post) {
            $splitPosts[] = $post->only(array_values(self::columnPairs()));
            $splitPosts[] = new TableSeparator(['colspan' => $headerSpan]);
        }
        array_pop($splitPosts);

        return $splitPosts;
    }

    /**
     * @return array|string|null
     */
    private function getRequestedStatus()
    {
        $status = $this->argument('status');
        $availableStatuses = ['published', 'queued'];
        if (!$status || !in_array($status, $availableStatuses, true)) {
            $status = $this->choice('¿Que noticias mostrar?', $availableStatuses, 'published');
        }

        return $status;
    }
}
