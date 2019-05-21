<?php

declare(strict_types=1);

namespace App\DTO;

class Post
{
    private $title;
    private $link;
    private $source;

    /**
     * Post constructor.
     * @param $title
     * @param $link
     * @param $source
     */
    public function __construct(string $title, string $link, string $source)
    {
        $this->title = $title;
        $this->link = $link;
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function source(): string
    {
        return $this->source;
    }
}