<?php

namespace App\Repositories;

use App\Models\Post;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository, CacheableInterface
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function updateOrCreateByLinkId(array $data, int $linkId)
    {
        if (!$this->model->where('link_id', $linkId)->first()) {
            return $this->model->create($data);
        }

        return $this->model->update($data);
    }
}
