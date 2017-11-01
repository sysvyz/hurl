<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringRightTrim extends AbstractStringNode
{
    public function __invoke(...$data)
    {
        return rtrim($data[0]);
    }
}