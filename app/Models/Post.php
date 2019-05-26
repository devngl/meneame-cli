<?php declare(strict_types = 1);

namespace App\Models;

use App\Models\Traits\UuidKey;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class FrontPagePost
 * @package App\Models
 * @property int $link_id
 */
final class Post extends Model implements Transformable
{
    use UuidKey, TransformableTrait;

    /** @var array<string> */
    protected $fillable = [
        'link_id',
        'title',
        'status',
        'votes',
        'karma',
        'comments',
        'order',
    ];
}
