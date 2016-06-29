<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:53
 */

namespace HurlTest;


use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Abstracts\Comparator\BooleanComparator;
use Hurl\Node\Math\MathNode;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_Comparator;
use Hurl\Node\Statics\_Filter;

class ComparatorTest extends \PHPUnit_Framework_TestCase
{


	public function testSort()
	{
		$data = [3, 5, 7, 2, 4];
		$node = _Array::sort(function ($a, $b) {
			return $a - $b;
		});
		$this->assertEquals([2, 3, 4, 5, 7], $node($data));

	}

	public function testSortWithComparator()
	{
		$data = [3, 5, 7, 2, 4];
		$node = _Array::sort(_Comparator::numeric());
		$this->assertEquals([2, 3, 4, 5, 7], $node($data));

	}

	public function testSortMapMap()
	{
		$data = [['4354', '54', '52'], ['45675', '435', '234223'], ['4354', '54']];
		$node = _Array::sort(_Comparator::boolean()->map(MathNode::sum())->map(_Filter::isEven()));
		$this->assertEquals([['45675', '435', '234223'], ['4354', '54', '52'], ['4354', '54']], $node($data));

	}

	public function testSortStrlen()
	{
		$data = ["gfbfbg", "xghgf", "cbnrtgh54fg", "7rjghngf", "cbncbncvb"];
		$node = _Array::sort(_Comparator::stringLength());

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
		$node = _Array::sort(_Comparator::alphaNumeric());

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
		$node = _Array::sort(_Comparator::alphaNumeric()->invert());

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
		$node = _Array::sort(_Comparator::numeric()->map($map));

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
		$node = _Array::sort(_Comparator::numeric()->map($map)->invert());

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
		$node = _Array::sort(_Comparator::numeric()->invert()->map($map));

		$this->assertEquals(
			[
				$d, $c, $b, $a
			]
			, $node($data));
	}

	public function testSortMapInvertMap()
	{
		$map = function ($obj) {
			return $obj->val;
		};
		$double = function ($val) {
			return $val * 2;
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
		$node = _Array::sort(_Comparator::numeric()->map($double)->invert()->map($map));

		$this->assertEquals(
			[
				$d, $c, $b, $a
			]
			, $node($data));
	}

	public function testSortInvertMapMap()
	{
		$map = function ($obj) {
			return $obj->val;
		};
		$double = function ($val) {
			return $val * 2;
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
		$node = _Array::sort(_Comparator::numeric()->invert()->map($map)->map($double));

		$this->assertEquals(
			[
				$d, $c, $b, $a
			]
			, $node($data));
	}

	public function testSortMapMapInvert()
	{
		$map = function ($obj) {
			return $obj->val;
		};
		$double = function ($val) {
			return $val * 2;
		};

		$a = new \stdClass();
		$a->val = -1.4;
		$b = new \stdClass();
		$b->val = -1.2;
		$c = new \stdClass();
		$c->val = 1.53;
		$d = new \stdClass();
		$d->val = 1.84;
		$data = [$c, $b, $a, $d];
		$node = _Array::sort(_Comparator::numeric()->map($map)->map($double)->invert());

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
			_Array::sort
			(
				_Comparator::numeric()
					->invert()
					->map($mapf)
					->then(_Comparator::numeric()
						->map($map)
						->invert()
					)
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
			_Array::values()->sort(
				_Comparator::numeric()->map($mapf)->invert(),
				_Comparator::numeric()->invert()->map($mapval)
			)
				->map($mapval)
				->implode('');

		$this->assertEquals(
			'4132'
			, $node($data));
	}

	public function testBoolean()
	{
		$data = [true, false, true, false, true, false, true];

		$cmpNode = _Comparator::boolean();
		$node = _Array::values()->sort(
			$cmpNode
		);

		$this->assertEquals(
			[false, false, false, true, true, true, true,]
			, $node($data));
		$this->assertInstanceOf(BooleanComparator::class, $cmpNode);
	}

	public function testBooleanInv()
	{

		$cmpNode = _Comparator::boolean()->invert();
		$data = [true, false, true, false, true, false, true];
		$node = _Array::values()->sort(
			$cmpNode
		);

		$this->assertEquals(
			[true, true, true, true, false, false, false,]
			, $node($data));
		$this->assertInstanceOf(AbstractComparator::class, $cmpNode);
	}

}