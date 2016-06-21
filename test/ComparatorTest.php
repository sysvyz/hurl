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

}