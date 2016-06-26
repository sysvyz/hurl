<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:53
 */

namespace HurlTest;


use Hurl\Node\ArrayNode;
use Hurl\Node\ComparatorNode;

class ComparatorTest extends \PHPUnit_Framework_TestCase
{


	public function testSort()
	{
		$data = [3, 5, 7, 2, 4];
		$node = ArrayNode::sort(function ($a, $b) {
			return $a - $b;
		});
		$this->assertEquals([2, 3, 4, 5, 7], $node($data));

	}

	public function testSortWithComparator()
	{
		$data = [3, 5, 7, 2, 4];
		$node = ArrayNode::sort(ComparatorNode::numeric());
		$this->assertEquals([2, 3, 4, 5, 7], $node($data));

	}

	public function testSortStrlen()
	{
		$data = ["gfbfbg", "xghgf", "cbnrtgh54fg", "7rjghngf", "cbncbncvb"];
		$node = ArrayNode::sort(ComparatorNode::stringLength());

		$this->assertEquals([
			"xghgf",
			"gfbfbg",
			"7rjghngf",
			"cbncbncvb",
			"cbnrtgh54fg"
		], $node($data));

	}

	public function testSortAlphaNumeric()
	{
		$data = ["sgdgd", "adsfd", "fdsgdf", "rgfv", "sfgfsfd"];
		$node = ArrayNode::sort(ComparatorNode::alphaNumeric());

		$this->assertEquals(
			[
				"adsfd",
				"fdsgdf",
				"rgfv",
				"sfgfsfd",
				"sgdgd",
			]
			, $node($data));
	}

	public function testSortAlphaNumericInvert()
	{
		$data = ["sgdgd", "adsfd", "fdsgdf", "rgfv", "sfgfsfd"];
		$node = ArrayNode::sort(ComparatorNode::alphaNumeric()->invert());

		$this->assertEquals(
			[
				"sgdgd",
				"sfgfsfd",
				"rgfv",
				"fdsgdf",
				"adsfd",
			]
			, $node($data));
	}

	public function testSortMap()
	{
		$map = function ($obj) {
			return $obj->val;
		};

		$a = new \stdClass();
		$a->val = 1;
		$b = new \stdClass();
		$b->val = 2;
		$c = new \stdClass();
		$c->val = 3;
		$d = new \stdClass();
		$d->val = 4;
		$data = [$c, $b, $a, $d];
		$node = ArrayNode::sort(ComparatorNode::numeric()->map($map));

		$this->assertEquals(
			[
				$a, $b, $c, $d
			]
			, $node($data));
	}

	public function testSortMapInvert()
	{
		$map = function ($obj) {
			return $obj->val;
		};

		$a = new \stdClass();
		$a->val = 1;
		$b = new \stdClass();
		$b->val = 2;
		$c = new \stdClass();
		$c->val = 3;
		$d = new \stdClass();
		$d->val = 4;
		$data = [$c, $b, $a, $d];
		$node = ArrayNode::sort(ComparatorNode::numeric()->map($map)->invert());

		$this->assertEquals(
			[
				$d, $c, $b, $a
			]
			, $node($data));
	}

	public function testSortInvertMap()
	{
		$map = function ($obj) {
			return $obj->val;
		};

		$a = new \stdClass();
		$a->val = 1;
		$b = new \stdClass();
		$b->val = 2;
		$c = new \stdClass();
		$c->val = 3;
		$d = new \stdClass();
		$d->val = 4;
		$data = [$c, $b, $a, $d];
		$node = ArrayNode::sort(ComparatorNode::numeric()->invert()->map($map));

		$this->assertEquals(
			[
				$d, $c, $b, $a
			]
			, $node($data));
	}

	public function testSortInvertMap_Map_Implode()
	{
		$map = function ($obj) {
			return $obj->val;
		};
		$mapf = function ($obj) {
			return $obj->f;
		};

		$a = new \stdClass();
		$a->val = 1;
		$a->f = 2;
		$b = new \stdClass();
		$b->val = 2;
		$b->f = 1;
		$c = new \stdClass();
		$c->val = 3;
		$c->f = 1;
		$d = new \stdClass();
		$d->val = 4;
		$d->f = 2;
		$data = [$c, $b, $a, $d];
		$node =
			ArrayNode::sort
			(
				ComparatorNode::numeric()
					->invert()
					->map($mapf)
					->then(ComparatorNode::numeric()
						->invert()
						->map($map))
			)
				->map($map)
				->implode('');

		$this->assertEquals(
			'4132'
			, $node($data));
	}

	public function testSortMultipleInvertMap_Map_Implode()
	{
		$mapval = function ($obj) {
			return $obj->val;
		};
		$mapf = function ($obj) {
			return $obj->f;
		};

		$a = new \stdClass();
		$a->val = 1;
		$a->f = 2;
		$b = new \stdClass();
		$b->val = 2;
		$b->f = 1;
		$c = new \stdClass();
		$c->val = 3;
		$c->f = 1;
		$d = new \stdClass();
		$d->val = 4;
		$d->f = 2;
		$data = [$c, $b, $a, $d];
		$node =
			ArrayNode::values()->sort(
				ComparatorNode::numeric()->invert()->map($mapf),
				ComparatorNode::numeric()->invert()->map($mapval)
			)
				->map($mapval)
				->implode('');

		$this->assertEquals(
			'4132'
			, $node($data));
	}
	

}