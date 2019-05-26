<?php declare(strict_types = 1);

namespace App\DTO;

final class Post
{
    /**
     * @var int
     */
    private $linkId;
    /**
     * @var string
     */
    private $title;
    /**
     * @var int
     */
    private $votes;
    /**
     * @var int
     */
    private $karma;
    /**
     * @var int
     */
    private $comments;
    /**
     * @var string
     */
    private $status;
    /**
     * @var int
     */
    private $order;

    /**
     * Post constructor.
     *
     * @param  int  $linkId
     * @param  string  $title
     * @param  string  $status
     * @param  int  $votes
     * @param  int  $karma
     * @param  int  $comments
     * @param  int  $order
     */
    public function __construct(
        int $linkId,
        string $title,
        string $status,
        int $votes = 0,
        int $karma = 0,
        int $comments = 0,
        int $order = 0
    ) {
        $this->linkId = $linkId;
        $this->title = $title;
        $this->status = $status;
        $this->votes = $votes;
        $this->karma = $karma;
        $this->comments = $comments;
        $this->order = $order;
    }

    public function linkId(): int
    {
        return $this->linkId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function votes(): int
    {
        return $this->votes;
    }

    public function karma(): int
    {
        return $this->karma;
    }

    public function comments(): int
    {
        return $this->comments;
    }

    public function order(): int
    {
        return $this->order;
    }
}
