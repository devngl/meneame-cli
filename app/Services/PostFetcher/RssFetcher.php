<?php

declare(strict_types=1);

namespace App\Services\PostFetcher;

use SimpleXMLElement;
use Throwable;

abstract class RssFetcher implements PostsFetcherInterface
{
    protected $url;

    /**
     * @return array
     * @throws Throwable
     */
    public function __invoke(): array
    {
        throw_if(!$this->url, new FetcherRequiresUrlException());

        $loadedRss = simplexml_load_string(file_get_contents($this->url));

        return $this->hydrate($loadedRss);
    }

    /**
     * @param SimpleXMLElement $loadedRss
     * @return array
     */
    abstract protected function hydrate(SimpleXMLElement $loadedRss): array;
}
