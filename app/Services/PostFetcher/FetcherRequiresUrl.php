<?php declare(strict_types = 1);

namespace App\Services\PostFetcher;

use Exception;

final class FetcherRequiresUrl extends Exception
{
    /**
     * @var string
     */
    protected $message = 'This fetcher requires an URL from where the data should be fetched';
}
