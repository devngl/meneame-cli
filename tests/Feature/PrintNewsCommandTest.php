<?php declare(strict_types = 1);

namespace Tests\Feature;

use App\Commands\PrintNews;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

final class PrintNewsCommandTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test
     *
     * @return void
     */
    public function test_show_news_command_outputs_info_message_when_database_empty()
    {
        $this->artisan(PrintNews::PRINT_NEWS_COMMAND)
            ->expectsQuestion('¿Que noticias mostrar?', 'published')
            ->expectsOutput('No hay ninguna noticia en nuestra base de datos.')
            ->assertExitCode(0);

        $this->artisan(PrintNews::PRINT_NEWS_COMMAND)
            ->expectsQuestion('¿Que noticias mostrar?', 'queued')
            ->expectsOutput('No hay ninguna noticia en nuestra base de datos.')
            ->assertExitCode(0);
    }

    public function test_show_news_command_with_data()
    {
        factory(Post::class, 10)->states('published')->create();
        $this->artisan(PrintNews::PRINT_NEWS_COMMAND)
            ->expectsQuestion('¿Que noticias mostrar?', 'published')
            ->assertExitCode(0);

        factory(Post::class, 10)->states('queued')->create();
        $this->artisan(PrintNews::PRINT_NEWS_COMMAND)
            ->expectsQuestion('¿Que noticias mostrar?', 'queued')
            ->assertExitCode(0);
    }
}
