<?php declare(strict_types = 1);

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

    public function getPostsByStatus(string $status, int $limit);

    public function cleanOrder();

    public function orderByRaw(string $rawOrder);

    public function clearCache();
}
