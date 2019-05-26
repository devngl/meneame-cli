<?php declare(strict_types = 1);

namespace App\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class LimitCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
final class LimitCriteria implements CriteriaInterface
{
    private $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
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
        return $model->limit($this->limit);
    }
}
