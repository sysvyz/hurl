<?php

namespace HurlTest;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Arrays\ArrayEach;
use Hurl\Node\Arrays\ArrayFilter;
use Hurl\Node\Arrays\ArrayMap;
use Hurl\Node\Arrays\ArrayMerge;
use Hurl\Node\Arrays\ArrayRecursiveMerge;
use Hurl\Node\Arrays\ArrayReduce;
use Hurl\Node\Arrays\ArraySort;
use Hurl\Node\Arrays\ArrayStableSort;
use Hurl\Node\Filters\ContainsFilter;
use Hurl\Node\Filters\IsEmptyFilter;
use Hurl\Node\Filters\Logic\NegatedFilter;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Comparators;
use Hurl\Node\Statics\Strings;
use PHPUnit_Framework_TestCase;

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
            Arrays::map(function ($val) {
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
        $before = Arrays::map(function ($a, $b) {
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
            Arrays::values()->map(function ($val) {
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
            Arrays::map(Strings::ucfirst());
        $this->assertInstanceOf(ArrayMap::class, $before);
        $this->assertInstanceOf(CollectionNodeInterface::class, $before);
        $this->assertInstanceOf(AbstractArray::class, $before);
        $this->assertInstanceOf(AbstractNode::class, $before);
        $this->assertEquals($before(['a.b'])[0], 'A.b');
    }


    public function testMapAsReduceNode()
    {
        $before =
            Arrays::reduce([], function ($a, $b) {
                $a[] = Strings::ucfirst()($b);
                return $a;
            });
        $this->assertInstanceOf(ArrayReduce::class, $before);
        $this->assertInstanceOf(CollectionNodeInterface::class, $before);
        $this->assertInstanceOf(AbstractArray::class, $before);
        $this->assertInstanceOf(AbstractNode::class, $before);
        $this->assertEquals($before(['a.b'])[0], 'A.b');
    }

    public function testArrayNodeReduce()
    {
        $do =
            Strings::explode('.')->reduce([], function ($a, $b) {
                $a[] = Strings::ucfirst()($b);
                return $a;
            });
        $this->assertInstanceOf(ArrayReduce::class, $do);
        $this->assertInstanceOf(CollectionNodeInterface::class, $do);
        $this->assertInstanceOf(AbstractArray::class, $do);
        $this->assertInstanceOf(AbstractNode::class, $do);
        $this->assertEquals($do('a.b.cc'), ['A','B','Cc']);
    }

    public function testArrayNodeMerge()
    {
        $do =
            Arrays::values()->merge();
        $this->assertInstanceOf(ArrayMerge::class, $do);
        $this->assertInstanceOf(CollectionNodeInterface::class, $do);
        $this->assertInstanceOf(AbstractArray::class, $do);
        $this->assertInstanceOf(AbstractNode::class, $do);
        $this->assertEquals($do(['ab'],['dD']), ['ab','dD']);
    }

    public function testSort()
    {
        $data = [4, 78, 2, 7, 4, 34, 43, 34];

        $sort = Arrays::values()->sort(function ($a, $b) {
            return $a - $b;
        });
        $this->assertInstanceOf(ArraySort::class, $sort);
        $this->assertInstanceOf(AbstractArray::class, $sort);
        $this->assertInstanceOf(AbstractNode::class, $sort);
        $this->assertInstanceOf(CollectionNodeInterface::class, $sort);

        $this->assertEquals($sort($data), [2, 4, 4, 7, 34, 34, 43, 78]);
    }

    public function testSum()
    {
        $data = [4, 78, 2, 7, 4, 34, 43, 34];
        $sort =  Arrays::reduce(0, function ($a, $b) {
            return $a+$b;
        });
        $this->assertEquals($sort($data), 206);
    }


    public function testRecursiveMerge()
    {
        $data = [1, [3, [5], 2, 5, [4, [7, 8], [4]]]];
        $data2 = [4, [8, 6], 3];
        $merge = Arrays::recursiveMerge();

        $this->assertInstanceOf(ArrayRecursiveMerge::class, $merge);
        $this->assertEquals($merge($data, $data2), [1, 3, 5, 2, 5, 4, 7, 8, 4, 4, 8, 6, 3]);
    }

    public function testMerge()
    {
        $data = [[1, 9], [7, 8], [3, 6], [2, 5, 4]];

        $merge = Arrays::merge();
        $this->assertInstanceOf(ArrayMerge::class, $merge);

        $this->assertEquals($merge(...$data), [1, 9, 7, 8, 3, 6, 2, 5, 4]);
    }


    public function testEach()
    {
        $stack = [];
        $count = 1;
        $push = Arrays::values()->each(function ($a) use (&$stack, &$count) {
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

        $filter = Arrays::filter();

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

        $filter = Arrays::values()->isEmpty();

        $this->assertInstanceOf(IsEmptyFilter::class, $filter);

        $d1 = [1];
        $d2 = [];

        $this->assertFalse($filter($d1));
        $this->assertTrue($filter($d2));

    }

    public function testNotIsEmpty()
    {

        $filter = Arrays::values()->isEmpty()->not();

        $this->assertInstanceOf(NegatedFilter::class, $filter);

        $d1 = [1];
        $d2 = [];

        $this->assertFalse($filter($d2));
        $this->assertTrue($filter($d1));

    }

    public function testContains()
    {

        $filter = Arrays::values()->contains(1);

        $this->assertInstanceOf(ContainsFilter::class, $filter);

        $d1 = [1];
        $d2 = [];
        $d3 = [43, 23, 123, 12];
        $d4 = [43, 23, 1, 123, 12];

        $this->assertTrue($filter($d1));
        $this->assertFalse($filter($d2));
        $this->assertFalse($filter($d3));
        $this->assertTrue($filter($d4));

    }

    public function testContainsStrict()
    {

        $filter = Arrays::values()->contains(1, true);

        $this->assertInstanceOf(ContainsFilter::class, $filter);

        $d0 = [1];
        $d1 = ['1'];
        $d2 = [];
        $d3 = [43, 23, 123, 12];
        $d4 = [43, 23, "1", 123, 12];
        $d5 = [43, 23, 1, 123, 12];

        $this->assertTrue($filter($d0));
        $this->assertFalse($filter($d1));
        $this->assertFalse($filter($d2));
        $this->assertFalse($filter($d3));
        $this->assertFalse($filter($d4));
        $this->assertTrue($filter($d5));

    }


    public function testStableSort()
    {

        $filter = Arrays::stableSort(function ($a, $b) {
            return $a['a'] - $b['a'];
        });

        $this->assertInstanceOf(ArrayStableSort::class, $filter);

        $data = [
            's' => ['a' => 32, 'b' => 's1'],
            'p' => ['a' => 34, 'b' => 'p1'],
            'l' => ['a' => 32, 'b' => 'l1'],
            'm' => ['a' => 31, 'b' => 'm1'],
            'n' => ['a' => 23, 'b' => 'm1'],
        ];
        $this->assertEquals($filter($data), [
            'n' => ['a' => 23, 'b' => 'm1'],
            'm' => ['a' => 31, 'b' => 'm1'],
            's' => ['a' => 32, 'b' => 's1'],
            'l' => ['a' => 32, 'b' => 'l1'],
            'p' => ['a' => 34, 'b' => 'p1'],
        ]);
    }

    public function testStableSort2()
    {

        $stableSort = Arrays::stableSort(
            Comparators::alphaNumeric()->map(function ($elem) {
                return $elem['b'];
            }),
            function ($a, $b) {
                return $a['a'] - $b['a'];
            });

        $this->assertInstanceOf(ArrayStableSort::class, $stableSort);

        $data = [
            'p' => ['a' => 34, 'b' => 'p1'],
            's' => ['a' => 32, 'b' => 's1'],
            'l' => ['a' => 32, 'b' => 'l1'],
            'm' => ['a' => 31, 'b' => 'm1'],
            'n' => ['a' => 23, 'b' => 'm1'],
        ];
        $this->assertEquals(json_encode($stableSort($data)), json_encode([
            'l' => ['a' => 32, 'b' => 'l1'],
            'n' => ['a' => 23, 'b' => 'm1'],
            'm' => ['a' => 31, 'b' => 'm1'],
            'p' => ['a' => 34, 'b' => 'p1'],
            's' => ['a' => 32, 'b' => 's1'],
        ]));
    }


}