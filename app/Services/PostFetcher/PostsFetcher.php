<?php declare(strict_types = 1);

namespace App\Services\PostFetcher;

use App\DTO\Post;

interface PostsFetcher
{
    /**
     * @return array<Post>
     */
    public function __invoke(): array;
}
