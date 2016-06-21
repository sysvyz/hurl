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
use Hurl\Node\Math\MathNode;

class MathTest extends \PHPUnit_Framework_TestCase
{

    public function testSum()
    {
        $data = [8, 5, 7, 2, 3];
        $node = MathNode::sum();
        $this->assertEquals(25, $node($data));

    }

    public function testAverage()
    {
        $data = [8, 5, 7, 2, 3];
        $node = MathNode::average();
        $this->assertEquals(5, $node($data));

    }

    public function testMedian()
    {
        $data = [8, 5, 7, 2, 3];
        $node = MathNode::median();
        $this->assertEquals(5, $node($data));

    }

    public function testMedian2()
    {
        $data = [8, 5, 7, 2, 3, 6];
        $node = MathNode::median();
        $this->assertEquals(5.5, $node($data));

    }


}