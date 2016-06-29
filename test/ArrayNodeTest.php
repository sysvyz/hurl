<?php
use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\Arrays\ArrayEach;
use Hurl\Node\Abstracts\Arrays\ArrayFilter;
use Hurl\Node\Abstracts\Arrays\ArrayMap;
use Hurl\Node\Abstracts\Arrays\ArraySort;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_String;

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
			_Array::map(function ($val) {
				return ucfirst($val);
			});
		$this->assertInstanceOf(CollectionNodeInterface::class, $before);
		$this->assertInstanceOf(ArrayMap::class, $before);
		$this->assertInstanceOf(AbstractArray::class, $before);
		$this->assertInstanceOf(AbstractNode::class, $before);
		$this->assertEquals($before(['a.b'])[0], 'A.b');
	}

	public function testMap2()
	{
		$before = _Array::map(function ($a, $b) {
			return [$a => $b];
		});
		$this->assertInstanceOf(CollectionNodeInterface::class, $before);
		$this->assertInstanceOf(ArrayMap::class, $before);
		$this->assertInstanceOf(AbstractArray::class, $before);
		$this->assertInstanceOf(AbstractNode::class, $before);
		$arr = ($before(['a', 'b'], ['c', 'd']));
		$this->assertEquals($arr[0]['a'], 'c');
		$this->assertEquals($arr[1]['b'], 'd');
	}

	public function testMap3()
	{
		$before =
			_Array::values()->map(function ($val) {
				return ucfirst($val);
			});
		$this->assertInstanceOf(CollectionNodeInterface::class, $before);
		$this->assertInstanceOf(ArrayMap::class, $before);
		$this->assertInstanceOf(AbstractArray::class, $before);
		$this->assertInstanceOf(AbstractNode::class, $before);
		$this->assertEquals($before(['a.b'])[0], 'A.b');
	}


	public function testMapNode()
	{
		$before =
			_Array::map(_String::ucfirst());
		$this->assertInstanceOf(ArrayMap::class, $before);
		$this->assertInstanceOf(CollectionNodeInterface::class, $before);
		$this->assertInstanceOf(AbstractArray::class, $before);
		$this->assertInstanceOf(AbstractNode::class, $before);
		$this->assertEquals($before(['a.b'])[0], 'A.b');
	}

	public function testSort()
	{
		$data = [4, 78, 2, 7, 4, 34, 43, 34];

		$sort = _Array::values()->sort(function ($a, $b) {
			return $a - $b;
		});
		$this->assertInstanceOf(ArraySort::class, $sort);
		$this->assertInstanceOf(AbstractArray::class, $sort);
		$this->assertInstanceOf(AbstractNode::class, $sort);
		$this->assertInstanceOf(CollectionNodeInterface::class, $sort);

		$this->assertEquals($sort($data), [2, 4, 4, 7, 34, 34, 43, 78]);
	}


	public function testRecursiveMerge()
	{
		$data = [1, [3, [5], 2, 5, [4, [7, 8], [4]]]];
		$data2 = [4, [8, 6], 3];
		$mergeSort = _Array::recursiveMerge()->sort(function ($a, $b) { // :D
			return $a - $b;
		});

		$this->assertInstanceOf(ArraySort::class, $mergeSort);
		$this->assertInstanceOf(AbstractArray::class, $mergeSort);
		$this->assertInstanceOf(AbstractNode::class, $mergeSort);
		$this->assertInstanceOf(CollectionNodeInterface::class, $mergeSort);
		$this->assertEquals($mergeSort(...[$data, $data2]), [1, 2, 3, 3, 4, 4, 4, 5, 5, 6, 7, 8, 8]);
		$this->assertEquals($mergeSort($data, $data2), [1, 2, 3, 3, 4, 4, 4, 5, 5, 6, 7, 8, 8]);
	}

	public function testMerge()
	{
		$data = [[1, 9], [7, 8], [3, 6], [2, 5, 4]];

		$mergeSort = _Array::merge()->sort(function ($a, $b) { // :D
			return $a - $b;
		});
		$this->assertInstanceOf(CollectionNodeInterface::class, $mergeSort);

		$this->assertInstanceOf(ArraySort::class, $mergeSort);
		$this->assertInstanceOf(AbstractArray::class, $mergeSort);
		$this->assertInstanceOf(AbstractNode::class, $mergeSort);
		$this->assertEquals($mergeSort(...$data), [1, 2, 3, 4, 5, 6, 7, 8, 9]);
	}


	public function testEach()
	{
		$stack = [];
		$count = 1;
		$push = _Array::values()->each(function ($a) use (&$stack, &$count) {
			$stack[] = $a;
			$this->assertEquals($count++, $a);
		});
		$this->assertInstanceOf(CollectionNodeInterface::class, $push);
		$this->assertInstanceOf(ArrayEach::class, $push);
		$this->assertInstanceOf(AbstractArray::class, $push);
		$this->assertInstanceOf(AbstractNode::class, $push);
		$push([1, 2, 3, 4, 5, 6, 7]);
		$this->assertEquals($stack, [1, 2, 3, 4, 5, 6, 7]);
		$this->assertEquals($count, 8);
	}


	public function testFilter()
	{

		$filter = _Array::filter();

		$this->assertInstanceOf(ArrayFilter::class, $filter);

		$this->assertInstanceOf(AbstractArray::class, $filter);
		$this->assertInstanceOf(AbstractNode::class, $filter);
		$this->assertInstanceOf(CollectionNodeInterface::class, $filter);

		$filter = $filter->values();
		$this->assertInstanceOf(CollectionNodeInterface::class, $filter);

		$this->assertInstanceOf(AbstractArray::class, $filter);
		$this->assertInstanceOf(AbstractNode::class, $filter);

		$this->assertArraySubset($filter([null, false, 1, 0.5, '', '0', 'a']), [1, 0.5, 'a']);
		$this->assertArraySubset([1, 0.5, 'a'], $filter([null, false, 1, 0.5, '', '0', 'a']));

	}


}