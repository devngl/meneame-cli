<?php declare(strict_types = 1);

namespace App\Services\PostHydrator;

use App\DTO\Post as DTOPost;
use App\Models\Post;

final class EloquentModelHydrator implements PostHydrator
{
    public function __invoke(DTOPost $dtoPost): Post
    {
        $postModel = new Post();

        $postModel->fill([
            'link_id' => $dtoPost->linkId(),
            'title' => $dtoPost->title(),
            'status' => $dtoPost->status(),
            'votes' => $dtoPost->votes(),
            'karma' => $dtoPost->karma(),
            'comments' => $dtoPost->comments(),
        ]);

        return $postModel;
    }
}
