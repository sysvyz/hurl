<?php
use Hurl\Node\FilterNode;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:53
 */
class FilterTest extends PHPUnit_Framework_TestCase
{

	public function testIsNumeric()
	{
		$filter = FilterNode::isNumeric();
		$this->assertTrue($filter(2));
		$this->assertTrue($filter("2"));
		$this->assertTrue($filter(2.));
		$this->assertTrue($filter(.2));
		$this->assertTrue($filter(0x4));
		$this->assertTrue($filter(04));
		$this->assertTrue($filter(4.0));
		$this->assertFalse($filter("a"));
		return $filter;
	}

	public function testIsString()
	{
		$filter = FilterNode::isString();
		$this->assertFalse($filter(2));
		$this->assertTrue($filter("2"));
		$this->assertTrue($filter("dfsdgfd"));
		$this->assertTrue($filter(""));
		$this->assertFalse($filter([]));
		return $filter;
	}

	public function testIsArray()
	{
		$filter = FilterNode::isArray();

		$this->assertTrue($filter([04]));
		$this->assertTrue($filter([]));
		$this->assertFalse($filter("a"));
		return $filter;
	}

	public function testIsEmpty()
	{
		$filter = FilterNode::isEmpty();

		$this->assertFalse($filter([04]));
		$this->assertFalse($filter("aaaa"));
		$this->assertTrue($filter(""));
		$this->assertFalse($filter("0"));
		$this->assertFalse($filter(false));
		$this->assertFalse($filter(true));
		$this->assertTrue($filter([]));
		return $filter;
	}

	public function testIsInt()
	{
		$filter = FilterNode::isInt();

		$this->assertTrue($filter(3));
		$this->assertFalse($filter([]));
		$this->assertFalse($filter(2.));
		$this->assertFalse($filter(.2));
		$this->assertFalse($filter("a"));
		return $filter;
	}

	public function testIsEven()
	{
		$filter = FilterNode::isEven();

		$this->assertFalse($filter(3));
		$this->assertFalse($filter([]));
		$this->assertTrue($filter(2.));
		$this->assertFalse($filter(1.2));
		$this->assertFalse($filter("a"));
		$this->assertFalse($filter("b"));
		$this->assertTrue($filter("10"));
		return $filter;
	}

	public function testIsOdd()
	{
		$filter = FilterNode::isOdd();


		$this->assertTrue($filter(3));
		$this->assertFalse($filter([]));
		$this->assertFalse($filter(2.));
		$this->assertTrue($filter(1.2));
		$this->assertFalse($filter("a"));
		$this->assertFalse($filter("b"));
		$this->assertFalse($filter("10"));


		return $filter;
	}

	/**
	 * @depends testIsArray
	 * @depends testIsEmpty
	 * @param $isArray
	 * @param $isEmpty
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testAnd($isArray, $isEmpty)
	{
		$filter = FilterNode:: and ($isArray, $isEmpty);

		$this->assertFalse($filter([04]));
		$this->assertTrue($filter([]));
		$this->assertFalse($filter(2));
		return $filter;
	}

	/**
	 * @depends testIsInt
	 * @depends testIsEven
	 * @param $isInt
	 * @param $isEven
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testAnd2($isInt, $isEven)
	{

		$filter = FilterNode:: and ($isInt, $isEven);

		$this->assertFalse($filter([04]));
		$this->assertFalse($filter([]));
		$this->assertTrue($filter(2));
		$this->assertFalse($filter("2"));
		$this->assertFalse($filter(1));
		return $filter;
	}

	/**
	 * @depends testIsInt
	 * @depends testIsEmpty
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testOr($isInt, $isEmpty)
	{
		$filter = FilterNode:: or ($isInt, $isEmpty);
		$this->assertFalse($filter([04]));
		$this->assertTrue($filter([]));
		$this->assertTrue($filter(2));
		$this->assertFalse($filter("2"));
		$this->assertTrue($filter(""));
		return $filter;
	}

	/**
	 * @depends testIsInt
	 * @depends testIsEven
	 * @depends testIsArray
	 * @depends testIsEmpty
	 * @depends testIsString
	 * @depends testIsNumeric
	 * @depends testIsOdd
	 * @param $isInt
	 * @param $isEven
	 * @param $isArray
	 * @param $isEmpty
	 * @param $isString
	 * @param $isNumeric
	 * @param $isOdd
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testAndOr($isInt, $isEven, $isArray, $isEmpty, $isString, $isNumeric, $isOdd)
	{
		$filter = FilterNode:: or (
			FilterNode:: and ($isInt, $isEven),
			FilterNode:: and ($isArray, $isEmpty),
			FilterNode:: and ($isString, $isNumeric, $isOdd)
		);
		$this->assertFalse($filter([04]));
		$this->assertTrue($filter([]));
		$this->assertTrue($filter(2));
		$this->assertFalse($filter("2"));
		$this->assertFalse($filter(""));
		$this->assertFalse($filter(1));
		$this->assertTrue($filter("1"));
		$this->assertTrue($filter("14353"));
		$this->assertTrue($filter("1.4"));
		$this->assertFalse($filter("2.4"));
		$this->assertFalse($filter("sdasd"));
		$this->assertFalse($filter(""));
		return $filter;
	}
}