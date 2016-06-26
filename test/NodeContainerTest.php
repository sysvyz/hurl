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

		$container = new class($before, $after){ use NodeContainer;}  ;
		$this->assertEquals($container('a.b'), 'a-b');

	}

	public function testExplode()
	{
		$before = StringNode::explode('.');
		$this->assertEquals($before('a.b')[0], 'a');
		$this->assertEquals($before('a.b')[1], 'b');

	}

	public function testImplode()
	{
		$before = ArrayNode::implode('-');


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


	public function testChain()
	{
		$data = 'abc-acdc-acab';

		$chain =
			ArrayNode::explode('-')
				->map(StringNode::ucfirst()->substring(0, 2))
				->implode('');

		$this->assertEquals('AbAcAc', $chain($data));
	}

	public function testChain2()
	{
		$data = '5abc-ac5f-38dc-acab';

		$chain =
			ArrayNode::explode('-')
				->map(Node::call(function ($data) {
					return hexdec($data);
				}))->sum();

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
		$call = ArrayNode::map($li)
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

}