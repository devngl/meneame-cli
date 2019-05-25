<?php declare(strict_types = 1);

namespace App\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PostStatusCriteria.
 *
 * @package namespace App\Criteria;
 */
final class PostStatusCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * Apply criteria in query repository
     *
     * @param  Builder  $model
     * @param  RepositoryInterface  $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('status', $this->status);
    }
}
