<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\UuidKey;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontPagePost
 * @package App\Models
 */
class Post extends Model
{
    use UuidKey;

    /** @var array<string> */
    protected $fillable = [
        'link_id',
        'title',
        'status',
        'votes',
        'karma',
        'comments',
    ];
}
