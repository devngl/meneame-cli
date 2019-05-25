<?php declare(strict_types = 1);

namespace App\Services\PostFetcher;

use App\DTO\Post;
use Exception;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;
use Throwable;

abstract class RssFetcher implements PostsFetcher
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @return array<Post>
     * @throws Throwable
     */
    public function __invoke(): array
    {
        throw_if(!$this->url, new FetcherRequiresUrl());

        // Not using simplexml_load_file > https://bugs.php.net/bug.php?id=62577
        $rssXml = file_get_contents($this->url);
        if (!$rssXml) {
            Log::channel('news')->error('RSS could not be fetched.');

            return [];
        }

        try {
            $loadedRss = simplexml_load_string($rssXml, 'SimpleXMLElement', LIBXML_NOCDATA);
        } catch (Exception $exception) {
            Log::channel('news')->error($exception->getMessage());

            return [];
        }

        return $this->hydrate($loadedRss);
    }

    /**
     * @param  SimpleXMLElement  $loadedRss
     * @return array<Post>
     */
    abstract protected function hydrate(SimpleXMLElement $loadedRss): array;
}
