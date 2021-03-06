<?php

namespace Hurl\Node\Strings;


use Hurl\Node\Abstracts\AbstractStringNode;

class StringUpperCaseFirst extends AbstractStringNode
{
    public function __invoke(...$data)
    {
        return ucfirst($data[0]);
    }
}