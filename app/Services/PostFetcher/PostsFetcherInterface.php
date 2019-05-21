<?php

declare(strict_types=1);

namespace App\Services\PostFetcher;

interface PostsFetcherInterface
{
    public function __invoke(): array;
}