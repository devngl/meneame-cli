<?php declare(strict_types = 1);

namespace App\Services\PostHydrator;

use App\DTO\Post as DTOPost;
use App\Models\Post;

interface PostHydrator
{
    public function __invoke(DTOPost $dtoPost): Post;
}
