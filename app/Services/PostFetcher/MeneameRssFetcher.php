<?php

declare(strict_types=1);

namespace App\Services\PostFetcher;

use App\DTO\Post;
use SimpleXMLElement;

final class MeneameRssFetcher extends RssFetcher
{
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param SimpleXMLElement $loadedRss
     * @return array
     */
    protected function hydrate(SimpleXMLElement $loadedRss): array
    {
        $posts = [];
        foreach ($loadedRss->channel->item as $post) {
            $posts[] = new Post((string) $post->title, (string) $post->link, (string) $post->guid);
        }

        return $posts;
    }
}
