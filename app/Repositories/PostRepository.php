<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepository.
 *
 * @package namespace App\Repositories;
 */
interface PostRepository extends RepositoryInterface
{
    public function updateOrCreateByLinkId(array $data, int $linkId);
}
