<?php declare(strict_types = 1);

namespace App\Repositories;

use App\Criteria\LimitCriteria;
use App\Criteria\PostStatusCriteria;
use App\Models\Post;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Repository\Helpers\CacheKeys;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
final class PostRepositoryEloquent extends BaseRepository implements PostRepository, CacheableInterface
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

    /**
     * @param  array  $data
     * @param  int  $linkId
     * @return bool|mixed
     * @throws ValidatorException
     */
    public function updateOrCreateByLinkId(array $data, int $linkId)
    {
        if (!$this->findWhere(['link_id' => $linkId])->first()) {
            return $this->create($data);
        }

        return $this->model->update($data);
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
        $this->orderBy('created_at', 'asc');

        return $this->all();
    }

    public function clearCache()
    {
        $keys = CacheKeys::getKeys(static::class);

        foreach ($keys as $key) {
            $this->getCacheRepository()->forget($key);
        }
    }
}
