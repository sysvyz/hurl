<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 03:40
 */

namespace HurlTest;


use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Nodes;
use Hurl\Node\Statics\Strings;
use Hurl\Out\Tag;
use Hurl\Out\TagNode;
use Hurl\Node\Container;

class ContainerNodeTest extends \PHPUnit_Framework_TestCase
{

    public function testContainer()
    {
        $before = function ($args) {
            return explode('.', $args);
        };
        $after = function ($args) {
            return implode('-', $args);
        };

        $container = new Container($before, $after);
        $this->assertEquals($container('a.b'), 'a-b');

    }

    public function testExplode()
    {
        $before = Strings::explode('.');
        $this->assertEquals($before('a.b')[0], 'a');
        $this->assertEquals($before('a.b')[1], 'b');

    }

    public function testImplode()
    {
        $before = Arrays::implode('-');


        $this->assertEquals($before(['a', 'b']), 'a-b');

    }

    public function testCall()
    {
        $before = Arrays::explode('.');
        $after = Arrays::implode('-');
        $append = $before->then($after);


        $this->assertEquals($append('a.b'), 'a-b');
        $this->assertEquals($before('a.b')[0], 'a');
        $this->assertEquals($before('a.b')[1], 'b');
        $this->assertEquals($after(['a', 'b']), 'a-b');

    }


    public function testChain()
    {
        $data = 'abc-acdc-acab';

        $chain =
            Arrays::explode('-')
                ->map(Strings::ucfirst()->substring(0, 2))
                ->implode('');

        $this->assertEquals('AbAcAc', $chain($data));
    }

    public function testChain2()
    {
        $data = '5abc-ac5f-38dc-acab';

        $chain =
            Arrays::explode('-')
                ->map(Nodes::init(function ($data) {
                    return hexdec($data);
                }))->sum();

        $this->assertEquals(126114, $chain($data));
    }

    public function testCall2()
    {
        $data = 5;
        $val1 = 7;
        $val2 = 11;
        $call = Nodes::init(function ($data) use ($val1) {
            return $data * $val1;
        })->then(function ($data) use ($val2) {
            return $data * $val2;
        });

        $this->assertEquals(385, $call($data));

    }

    public function testTagElement()
    {
        $data = ["aaa", "bbbb"];

        $li = TagNode::element('li', ['class' => 'le']);
        $ul = TagNode::element('ul', ['class' => 'fl']);
        $call = Arrays::map($li)
            ->implode('')
            ->then($ul);

        $this->assertEquals($call($data), '<ul class="fl"><li class="le">aaa</li><li class="le">bbbb</li></ul>');
    }


    public function testTag()
    {
        $l1 = Tag::li()->inner(['aaa'])->setAttributes(['class' => 'le li']);
        $l2 = Tag::li()->inner(['aaa'])->setAttributes(['class' => 'le']);
        $data = Tag::ul()->inner([$l1, $l2])->setAttributes(['class' => 'ul']);
        $ul = TagNode::tag();

        $this->assertEquals($ul($data), '<ul class="ul"><li class="le li">aaa</li><li class="le">aaa</li></ul>');
    }

}