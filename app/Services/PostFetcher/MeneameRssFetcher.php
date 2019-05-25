<?php declare(strict_types = 1);

namespace App\Services\PostFetcher;

use App\DTO\Post;
use SimpleXMLElement;

final class MeneameRssFetcher extends RssFetcher
{
    /**
     * MeneameRssFetcher constructor.
     *
     * @param  string  $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param  SimpleXMLElement  $loadedRss
     * @return array<Post>
     */
    protected function hydrate(SimpleXMLElement $loadedRss): array
    {
        $posts = [];
        foreach ($loadedRss->channel->item as $post) {
            $namespacesMeta = $post->getNamespaces(true);
            $meta = $post->children($namespacesMeta[config('meneame.meta_namespace')]);
            $posts[] = new Post(
                (int) $meta->link_id,
                (string) $post->title,
                (string) $meta->status,
                (int) $meta->votes,
                (int) $meta->karma,
                (int) $meta->comments
            );
        }

        return $posts;
    }
}
