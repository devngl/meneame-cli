<?php declare(strict_types = 1);

namespace App\Commands;

use App\Models\Post;
use App\Repositories\PostRepository;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Helper\TableSeparator;

final class PrintNews extends Command
{
    /** @var string */
    protected $signature = 'news:show
                            {limit=20 : Cantidad de noticias máxima a mostrar}';

    /** @var string */
    protected $description = 'Muestra las noticias más actuales';

    /**
     * @param  PostRepository  $repository
     */
    public function handle(PostRepository $repository)
    {
        $status = $this->choice('¿Que noticias mostrar?', ['published', 'queued'], 0);
        $limit = (int) $this->argument('limit');

        $posts = $repository->getPostsByStatus($status, $limit);

        $this->printPosts($posts);
    }

    /**
     * @param $posts
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
     * @param $posts
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
}
