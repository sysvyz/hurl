<?php

namespace HurlTest;


use Hurl\Node\Node;
use Hurl\Out\Tag;

class XNodeTest extends \PHPUnit_Framework_TestCase
{


    public function testXNode()
    {
        $data = ['abc', 'qwert', 'xyz'];



        $fn = Node::call(function ($data) {
            $map = Node::map(function ($value) {
                return Tag::init('li')->inner($value);
            });
            return Tag::init('ul')->inner($map($data));
        });


        var_dump($fn($data).'');
    }
}

