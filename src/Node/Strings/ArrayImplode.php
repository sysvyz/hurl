<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class ArrayImplode extends AbstractStringNode
{
    private $glue;

    public function __construct($glue)
    {
        $this->glue = $glue;
    }

    public function __invoke(...$data)
    {
        return implode($this->glue, $data[0]);
    }
}