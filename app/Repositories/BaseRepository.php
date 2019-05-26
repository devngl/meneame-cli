<?php declare(strict_types = 1);

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as LaravelRepository;

abstract class BaseRepository extends LaravelRepository
{
    public function orderByRaw(string $rawOrder)
    {
        $this->model = $this->model->newQuery()->orderByRaw($rawOrder);

        return $this;
    }
}
