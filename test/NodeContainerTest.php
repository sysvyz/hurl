<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:40
 */

namespace HurlTest;


use Hurl\Node\ArrayNode;
use Hurl\Node\StringNode;
use Hurl\Node\Node;
use Hurl\Node\NodeContainer;
use Hurl\Out\Tag;
use Hurl\Out\TagNode;

class NodeContainerTest extends \PHPUnit_Framework_TestCase
{

    public function testContainer()
    {
        $before = function ($args) {
            return explode('.', $args);
        };
        $after = function ($args) {
            return implode('-', $args);
        };

        $container = new NodeContainer($before, $after);
        $this->assertEquals($container('a.b'), 'a-b');

    }

    public function testExplode()
    {
        $before = Node::explode('.');
        $this->assertEquals($before('a.b')[0], 'a');
        $this->assertEquals($before('a.b')[1], 'b');

    }

    public function testImplode()
    {
        $before = Node::implode('-');


        $this->assertEquals($before(['a', 'b']), 'a-b');

    }

    public function testCall()
    {
        $before = ArrayNode::explode('.');
        $after = ArrayNode::implode('-');
        $append = $before->call($after);


        $this->assertEquals($append('a.b'), 'a-b');
        $this->assertEquals($before('a.b')[0], 'a');
        $this->assertEquals($before('a.b')[1], 'b');
        $this->assertEquals($after(['a', 'b']), 'a-b');

    }

    public function testMap()
    {
        $before =
            Node::map(function ($val) {
                return ucfirst($val);
            });
        $this->assertEquals($before(['a.b'])[0], 'A.b');
    }

    public function testMap2()
    {
        $before = Node::map(function ($a, $b) {
            return [$a => $b];
        });
        $arr = ($before(['a', 'b'], ['c', 'd']));
        $this->assertEquals($arr[0]['a'], 'c');
        $this->assertEquals($arr[1]['b'], 'd');
    }

    public function testMapNode()
    {
        $before =
            Node::map(Node::ucfirst());
        $this->assertEquals($before(['a.b'])[0], 'A.b');
    }

    public function testChain()
    {
        $data = 'abc-acdc-acab';

        $chain =
            Node::explode('-')
                ->map(StringNode::ucfirst()->substring(0, 2))
                ->implode('');

        $this->assertEquals('AbAcAc', $chain($data));
    }

    public function testChain2()
    {
        $data = '5abc-ac5f-38dc-acab';

        $chain =
            Node::explode('-')
                ->map(Node::call(function ($data) {
                    return hexdec($data);
                }))->sum();;

        $this->assertEquals(126114, $chain($data));
    }

    public function testCall2()
    {
        $data = 5;
        $val1 = 7;
        $val2 = 11;
        $call = Node::call(function ($data) use ($val1) {
            return $data * $val1;
        })->call(function ($data) use ($val2) {
            return $data * $val2;
        });

        $this->assertEquals(385, $call($data));

    }

    public function testTagElement()
    {
        $data = ["aaa", "bbbb"];

        $li = TagNode::element('li', ['class' => 'le']);
        $ul = TagNode::element('ul', ['class' => 'fl']);
        $call = Node::map($li)
            ->implode('')
            ->then($ul);

        $this->assertEquals($call($data), '<ul class="fl"><li class="le">aaa</li><li class="le">bbbb</li></ul>');
    }


    public function testTag()
    {
        $l1 = new Tag('li', ['class' => 'le li'], ['aaa']);
        $l2 = new Tag('li', ['class' => 'le'], ['aaa']);
        $data = new Tag('ul', ['class' => 'ul'], [$l1, $l2]);
        $ul = TagNode::tag();

        $this->assertEquals($ul($data), '<ul class="ul"><li class="le li">aaa</li><li class="le">aaa</li></ul>');
    }

    public function testSort()
    {
        $data = [4, 78, 2, 7, 4, 34, 43, 34];

        $sort = ArrayNode::sort(function ($a, $b) {
            return $a - $b;
        });

        $this->assertEquals($sort($data), [2, 4, 4, 7, 34, 34, 43, 78]);
    }


    public function testRecursiveMerge()
    {
        $data = [1, [3, [5], 2, 5, [4, [7, 8], [4]]]];
        $data2 = [4, [8, 6], 3];
        $merge = ArrayNode::recursiveMerge()->sort(function ($a, $b) {
            return $a - $b;
        });

        $this->assertEquals($merge($data, $data2), [1, 2, 3, 3, 4, 4, 4, 5, 5, 6, 7, 8, 8]);
    }
}