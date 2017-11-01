<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringSubstring extends AbstractStringNode
{
    private $start;
    private $length;

    /**
     *  constructor.
     * @param $start
     * @param $length
     */
    public function __construct($start, $length)
    {
        $this->start = $start;
        $this->length = $length;
    }

    public function __invoke(...$data)
    {
        return substr($data[0], $this->start, $this->length);
    }
}