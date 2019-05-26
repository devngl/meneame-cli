<?php declare(strict_types = 1);

namespace App\Repositories;

use App\Criteria\LimitCriteria;
use App\Criteria\PostStatusCriteria;
use App\Models\Post;
use App\Repositories\Contracts\ClearableCache;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
final class PostRepositoryEloquent extends BaseRepository implements PostRepository, CacheableInterface, ClearableCache
{
    use CacheableRepository, Traits\ClearableCache;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }

    /**
     * @param  array  $data
     * @param  int  $linkId
     * @return bool|mixed
     * @throws ValidatorException
     */
    public function updateOrCreateByLinkId(array $data, int $linkId)
    {
        return $this->updateOrCreate(['link_id' => $linkId], $data);
    }

    /**
     * @param  string  $status
     * @param  int  $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function getPostsByStatus(string $status, int $limit)
    {
        $this->pushCriteria(new PostStatusCriteria($status));
        $this->pushCriteria(new LimitCriteria($limit));

        // invert order to push null columns last
        $this->orderByRaw('-`order` desc');

        return $this->all();
    }

    public function cleanOrder()
    {
        $this->model->newQuery()->update(['order' => null]);
    }
}
