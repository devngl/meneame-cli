<?php declare(strict_types = 1);

namespace Tests\Unitary\app\Repositories;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

final class PostRepositoryEloquent extends TestCase
{
    use DatabaseMigrations;

    /**
     * @throws BindingResolutionException
     */
    public function test_clear_order_sets_all_at_null()
    {
        $repository = $this->app->make(PostRepository::class);

        factory(Post::class, 100)->create();

        $postsWithOrder = $this->countPostsWithOrder();
        $this->assertGreaterThan(0, $postsWithOrder);

        // Clean the order expecting that all orders are set to null
        $repository->cleanOrder();

        $postsWithOrder = $this->countPostsWithOrder();
        $this->assertEquals(0, $postsWithOrder);
    }

    private function countPostsWithOrder(): int
    {
        return Post::query()->whereNotNull('order')->count();
    }
}
