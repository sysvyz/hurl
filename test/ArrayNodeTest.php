<?php
use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\Arrays\ArrayEach;
use Hurl\Node\Abstracts\Arrays\ArrayFilter;
use Hurl\Node\Abstracts\Arrays\ArrayMap;
use Hurl\Node\Abstracts\Arrays\ArraySort;
use Hurl\Node\Abstracts\Arrays\ArrayStableSort;
use Hurl\Node\Abstracts\Filters\ContainsFilter;
use Hurl\Node\Abstracts\Filters\IsEmptyFilter;
use Hurl\Node\Abstracts\Filters\Logic\NegatedFilter;
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
	public function testIsEmpty()
	{

		$filter = _Array::values()->isEmpty();

		$this->assertInstanceOf(IsEmptyFilter::class, $filter);

		$d1 = [1];
		$d2 = [];

		$this->assertFalse($filter($d1));
		$this->assertTrue($filter($d2));

	}

	public function testNotIsEmpty()
	{

		$filter = _Array::values()->isEmpty()->not();

		$this->assertInstanceOf(NegatedFilter::class, $filter);

		$d1 = [1];
		$d2 = [];

		$this->assertFalse($filter($d2));
		$this->assertTrue($filter($d1));

	}

	public function testContains()
	{

		$filter = _Array::values()->contains(1);

		$this->assertInstanceOf(ContainsFilter::class, $filter);

		$d1 = [1];
		$d2 = [];
		$d3 = [43,23,123,12];
		$d4 = [43,23,1,123,12];

		$this->assertTrue($filter($d1));
		$this->assertFalse($filter($d2));
		$this->assertFalse($filter($d3));
		$this->assertTrue($filter($d4));

	}

	public function testContainsStrict()
	{

		$filter = _Array::values()->contains(1,true);

		$this->assertInstanceOf(ContainsFilter::class, $filter);

		$d0 = [1];
		$d1 = ['1'];
		$d2 = [];
		$d3 = [43,23,123,12];
		$d4 = [43,23,"1",123,12];
		$d5 = [43,23,1,123,12];

		$this->assertTrue($filter($d0));
		$this->assertFalse($filter($d1));
		$this->assertFalse($filter($d2));
		$this->assertFalse($filter($d3));
		$this->assertFalse($filter($d4));
		$this->assertTrue($filter($d5));

	}


	public function testStableSort()
	{

		$filter = _Array::stableSort(function ($a,$b){
			return $a['a']-$b['a'];
		});

		$this->assertInstanceOf(ArrayStableSort::class, $filter);

		$data = [
			's'=>['a'=>32,'b'=>'s1'],
			'p'=>['a'=>34,'b'=>'p1'],
			'l'=>['a'=>32,'b'=>'l1'],
			'm'=>['a'=>31,'b'=>'m1'],
			'n'=>['a'=>23,'b'=>'n1'],
			]
		;

		print_r($filter($data));

	}


}