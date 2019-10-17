<?php
/**
 * Created by IntelliJ IDEA.
 * User: xavier
 * Date: 2019-10-07
 * Time: 14:18
 */

namespace App\Message;


class AbstractMessage
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}