<?php
use Hurl\Node\ArrayNode;
use Hurl\Node\StringNode;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 04:44
 */
class ArrayNodeTest extends PHPUnit_Framework_TestCase
{

	public function testMap()
	{
		$before =
			ArrayNode::map(function ($val) {
				return ucfirst($val);
			});
		$this->assertEquals($before(['a.b'])[0], 'A.b');
	}

	public function testMap2()
	{
		$before = ArrayNode::map(function ($a, $b) {
			return [$a => $b];
		});
		$arr = ($before(['a', 'b'], ['c', 'd']));
		$this->assertEquals($arr[0]['a'], 'c');
		$this->assertEquals($arr[1]['b'], 'd');
	}

	public function testMapNode()
	{
		$before =
			ArrayNode::map(StringNode::ucfirst());
		$this->assertEquals($before(['a.b'])[0], 'A.b');
	}

	public function testSort()
	{
		$data = [4, 78, 2, 7, 4, 34, 43, 34];

		$sort = ArrayNode::values()->sort(function ($a, $b) {
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


	public function testEach()
	{
		$stack = [];
		$count = 1;
		$push = ArrayNode::values()->each(function ($a) use (&$stack,&$count) {
			$stack[] = $a;
			$this->assertEquals($count++, $a);
		});
		$push([1, 2, 3, 4, 5, 6, 7]);
		$this->assertEquals($stack, [1, 2, 3, 4, 5, 6, 7]);
		$this->assertEquals($count, 8);
	}



}