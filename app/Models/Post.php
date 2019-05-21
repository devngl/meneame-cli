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

    protected $fillable = [
        'title',
        'positive_votes',
        'negative_votes',
        'anonymous_votes',
        'karma',
        'source',
        'queued',
    ];
}