<?php

declare(strict_types=1);

namespace App\Services\PostFetcher;

use Exception;

class FetcherRequiresUrlException extends Exception
{
    protected $message = 'This fetcher requires an URL from where the data should be fetched';
}