<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringLowerCase extends AbstractStringNode
{
    public function __invoke(...$data)
    {
        return strtolower($data[0]);
    }
}