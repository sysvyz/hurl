<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:53
 */

namespace HurlTest;


use Hurl\Node\Statics\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{

	public function testSum()
	{
		$data = [8, 5, 7, 2, 3];
		$node = Math::sum();
		$this->assertEquals(25, $node($data));

	}

	public function testProduct()
	{
		$data = [1, 2, 3, 4, 5];
		$node = Math::product();
		$this->assertEquals(120, $node($data));

	}

	public function testAverage()
	{
		$data = [8, 5, 7, 2, 3];
		$node = Math::average();
		$this->assertEquals(5, $node($data));

	}

	public function testMedian()
	{
		$data = [8, 5, 7, 2, 3];
		$node = Math::median();
		$this->assertEquals(5, $node($data));

	}

	public function testMedian2()
	{
		$data = [8, 5, 7, 2, 3, 6];
		$node = Math::median();
		$this->assertEquals(5.5, $node($data));
	}


}