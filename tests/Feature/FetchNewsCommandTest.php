<?php

namespace Tests\Feature;

use App\Commands\FetchFrontPageNews;
use App\Commands\FetchNews;
use App\Commands\FetchQueuedNews;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FetchNewsCommandTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test
     *
     * @return void
     */
    public function test_fetch_news_command_calls_children_commands()
    {
        $this->artisan(FetchNews::FETCH_NEWS_COMMAND);

        $this->assertCommandCalled(FetchFrontPageNews::FETCH_FRONT_PAGE_NEWS_COMMAND);
        $this->assertCommandCalled(FetchQueuedNews::FETCH_QUEUED_NEWS_COMMAND);
    }
}
