<?php
use Hurl\Node\Abstracts\AbstractFilterNode;
use Hurl\Node\ArrayNode;
use Hurl\Node\FilterNode;
use Type\AbstractAndFilter;
use Type\AbstractGreaterOrEqualFilter;
use Type\AbstractGreaterThanFilter;
use Type\AbstractIsArrayFilter;
use Type\AbstractIsEmptyFilter;
use Type\AbstractIsEqualFilter;
use Type\AbstractIsEvenFilter;
use Type\AbstractIsIntegerFilter;
use Type\AbstractIsNotEqualFilter;
use Type\AbstractIsNumericFilter;
use Type\AbstractIsOddFilter;
use Type\AbstractIsStringFilter;
use Type\AbstractLessOrEqualFilter;
use Type\AbstractLessThanFilter;
use Type\AbstractNegatedFilter;
use Type\AbstractOrFilter;

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
		$isNumeric = FilterNode::isNumeric();
		$this->assertTrue($isNumeric(2));
		$this->assertTrue($isNumeric("2"));
		$this->assertTrue($isNumeric(2.));
		$this->assertTrue($isNumeric(.2));
		$this->assertTrue($isNumeric(0x4));
		$this->assertTrue($isNumeric(04));
		$this->assertTrue($isNumeric(4.0));
		$this->assertFalse($isNumeric("a"));
		return $isNumeric;
	}
	public function testGreaterThan()
	{
		$filter = FilterNode::isGreaterThan(5);
		$this->assertInstanceOf(AbstractGreaterThanFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testGreaterThan_Not()
	{
		$filter = FilterNode::isGreaterThan(5)->not();
		$this->assertInstanceOf(AbstractLessOrEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testGreaterThan_Not_Not()
	{
		$filter = FilterNode::isGreaterThan(5)->not()->not();
		$this->assertInstanceOf(AbstractGreaterThanFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return AbstractGreaterOrEqualFilter
	 */
	public function testGreaterOrEqual()
	{
		$filter = FilterNode::isGreaterOrEqual(5);
		$this->assertInstanceOf(AbstractGreaterOrEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return \Hurl\Node\Abstracts\AbstractArrayNode|mixed
	 */
	public function testGreaterOrEqual_Not()
	{
		$filter = FilterNode::isGreaterOrEqual(5)->not();
		$this->assertInstanceOf(AbstractLessThanFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testGreaterOrEqual_Not_Not()
	{
		$filter = FilterNode::isGreaterOrEqual(5)->not()->not();
		$this->assertInstanceOf(AbstractGreaterOrEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testLessThan()
	{
		$filter = FilterNode::isLessThan(5);
		$this->assertInstanceOf(AbstractLessThanFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testLessThan_Not()
	{
		$filter = FilterNode::isLessThan(5)->not();
		$this->assertInstanceOf(AbstractGreaterOrEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testLessThan_Not_Not()
	{
		$filter = FilterNode::isLessThan(5)->not()->not();
		$this->assertInstanceOf(AbstractLessThanFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testLessOrEqual()
	{
		$filter = FilterNode::isLessOrEqual(5);
		$this->assertInstanceOf(AbstractLessOrEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testLessOrEqual_Not()
	{
		$filter = FilterNode::isLessOrEqual(5)->not();
		$this->assertInstanceOf(AbstractGreaterThanFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testLessOrEqual_Not_Not()
	{
		$filter = FilterNode::isLessOrEqual(5)->not()->not();
		$this->assertInstanceOf(AbstractLessOrEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testIsEqual()
	{
		$filter = FilterNode::isEqual(5);
		$this->assertInstanceOf(AbstractIsEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testIsEqual_Not()
	{
		$filter = FilterNode::isEqual(5)->not();
		$this->assertInstanceOf(AbstractIsNotEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testIsEqual_Not_Not()
	{
		$filter = FilterNode::isEqual(5)->not()->not();
		$this->assertInstanceOf(AbstractIsEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testIsNotEqual()
	{
		$filter = FilterNode::isNotEqual(5);
		$this->assertInstanceOf(AbstractIsNotEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}
	public function testIsNotEqual_Not()
	{
		$filter = FilterNode::isNotEqual(5)->not();
		$this->assertInstanceOf(AbstractIsEqualFilter::class,$filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}
	public function testIsNotEqual_Not_Not()
	{
		$filter = FilterNode::isNotEqual(5)->not()->not();
		$this->assertInstanceOf(AbstractIsNotEqualFilter::class,$filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return \Hurl\Node\Abstracts\AbstractArrayNode
	 */
	public function testIsNotNumeric()
	{
		$isNotNumeric = FilterNode::isNumeric()->not();
		$this->assertInstanceOf(AbstractNegatedFilter::class,$isNotNumeric);
		$this->assertFalse($isNotNumeric(2));
		$this->assertFalse($isNotNumeric("2"));
		$this->assertFalse($isNotNumeric(2.));
		$this->assertFalse($isNotNumeric(.2));
		$this->assertFalse($isNotNumeric(0x4));
		$this->assertFalse($isNotNumeric(04));
		$this->assertFalse($isNotNumeric(4.0));
		$this->assertTrue($isNotNumeric("a"));
		return $isNotNumeric;
	}
	/**
	 * @return \Hurl\Node\Abstracts\AbstractArrayNode
	 */
	public function testIsNotNumeric_Not()
	{
		$isNotNumeric = FilterNode::isNumeric()->not()->not();
		$this->assertInstanceOf(AbstractIsNumericFilter::class,$isNotNumeric);
		$this->assertTrue($isNotNumeric(2));
		$this->assertTrue($isNotNumeric("2"));
		$this->assertTrue($isNotNumeric(2.));
		$this->assertTrue($isNotNumeric(.2));
		$this->assertTrue($isNotNumeric(0x4));
		$this->assertTrue($isNotNumeric(04));
		$this->assertTrue($isNotNumeric(4.0));
		$this->assertFalse($isNotNumeric("a"));
		return $isNotNumeric;
	}

	/**
	 * @return AbstractIsStringFilter
	 */
	public function testIsString()
	{
		$isString = FilterNode::isString();
		$this->assertInstanceOf(AbstractIsStringFilter::class,$isString);
		$this->assertFalse($isString(2));
		$this->assertTrue($isString("2"));
		$this->assertTrue($isString("dfsdgfd"));
		$this->assertTrue($isString(""));
		$this->assertFalse($isString([]));
		return $isString;
	}

	/**
	 * @return AbstractIsArrayFilter
	 */
	public function testIsArray()
	{
		$isArray = FilterNode::isArray();
		$this->assertInstanceOf(AbstractIsArrayFilter::class,$isArray);

		$this->assertTrue($isArray([04]));
		$this->assertTrue($isArray([]));
		$this->assertFalse($isArray("a"));
		return $isArray;
	}

	/**
	 * @return AbstractFilterNode
	 */
	public function testIsEmpty()
	{
		$isEmpty = FilterNode::isEmpty();
		$this->assertInstanceOf(AbstractIsEmptyFilter::class,$isEmpty);

		$this->assertFalse($isEmpty([04]));
		$this->assertFalse($isEmpty("aaaa"));
		$this->assertTrue($isEmpty(""));
		$this->assertFalse($isEmpty("0"));
		$this->assertFalse($isEmpty(false));
		$this->assertFalse($isEmpty(true));
		$this->assertTrue($isEmpty([]));
		return $isEmpty;
	}

	/**
	 * @return AbstractIsIntegerFilter
	 */
	public function testIsInt()
	{
		$isInt = FilterNode::isInt();
		$this->assertInstanceOf(AbstractIsIntegerFilter::class,$isInt);

		$this->assertTrue($isInt(3));
		$this->assertFalse($isInt([]));
		$this->assertFalse($isInt(2.));
		$this->assertFalse($isInt(.2));
		$this->assertFalse($isInt("a"));
		return $isInt;
	}

	/**
	 * @return AbstractIsEvenFilter
	 */
	public function testIsEven()
	{
		$isEven = FilterNode::isEven();
		$this->assertInstanceOf(AbstractIsEvenFilter::class,$isEven);

		$this->assertFalse($isEven(3));
		$this->assertFalse($isEven([]));
		$this->assertTrue($isEven(2.));
		$this->assertFalse($isEven(1.2));
		$this->assertFalse($isEven("a"));
		$this->assertFalse($isEven("b"));
		$this->assertTrue($isEven("10"));
		return $isEven;
	}

	/**
	 * @return AbstractIsOddFilter
	 */
	public function testIsOdd()
	{
		$isOdd = FilterNode::isOdd();
		$this->assertInstanceOf(AbstractIsOddFilter::class,$isOdd);


		$this->assertTrue($isOdd(3));
		$this->assertFalse($isOdd([]));
		$this->assertFalse($isOdd(2.));
		$this->assertTrue($isOdd(1.2));
		$this->assertFalse($isOdd("a"));
		$this->assertFalse($isOdd("b"));
		$this->assertFalse($isOdd("10"));


		return $isOdd;
	}

	/**
	 * @depends testIsOdd
	 * @param AbstractIsOddFilter $isOdd
	 * @return AbstractIsOddFilter
	 */
	public function testIsOdd_Not_IsEven_Not(AbstractIsOddFilter $isOdd){
		$even = $isOdd->not();
		$this->assertInstanceOf(AbstractIsEvenFilter::class,$even);
		$odd = $even->not();
		$this->assertInstanceOf(AbstractIsOddFilter::class,$odd);
		return $isOdd;
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
		$and = FilterNode:: and ($isArray, $isEmpty);
		$this->assertInstanceOf(AbstractAndFilter::class,$and);

		$this->assertFalse($and([04]));
		$this->assertTrue($and([]));
		$this->assertFalse($and(2));
		return $and;
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

		$and = FilterNode:: and ($isInt, $isEven);
		$this->assertInstanceOf(AbstractAndFilter::class,$and);

		$this->assertFalse($and([04]));
		$this->assertFalse($and([]));
		$this->assertTrue($and(2));
		$this->assertFalse($and("2"));
		$this->assertFalse($and(1));
		return $and;
	}

	/**
	 * @depends testIsInt
	 * @depends testIsEven
	 * @param $isInt
	 * @param $isEven
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testNand($isInt, $isEven)
	{

		$nand = FilterNode:: and ($isInt, $isEven)->not();
		$this->assertInstanceOf(AbstractNegatedFilter::class,$nand);

		$this->assertTrue($nand([04]));
		$this->assertTrue($nand([]));
		$this->assertFalse($nand(2));
		$this->assertTrue($nand("2"));
		$this->assertTrue($nand(1));
		return $nand;
	}

	/**
	 * @depends testIsInt
	 * @depends testIsEmpty
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testOr($isInt, $isEmpty)
	{
		$filter = FilterNode:: or ($isInt, $isEmpty);
		$this->assertInstanceOf(AbstractOrFilter::class,$filter);
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
		$this->assertInstanceOf(AbstractOrFilter::class,$filter);
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

	/**
	 * @depends testAndOr
	 * @param $filter
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testArrayFilter($filter)
	{
		$arrayfilter = ArrayNode::filter($filter)->values();

		$data = [[04], [], 2, "2", "", 1, "1", "14353", "1.4", "2.4", "sdasd", ""];
		$this->assertEquals($arrayfilter($data), [[], 2, "1", "14353", "1.4"]);


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
	public function testNotAndOr(
		AbstractFilterNode $isInt,
		AbstractFilterNode $isEven,
		AbstractFilterNode $isArray,
		AbstractFilterNode $isEmpty,
		AbstractFilterNode $isString,
		AbstractFilterNode $isNumeric,
		AbstractFilterNode $isOdd
	)
	{
		$filter = FilterNode:: or (
			FilterNode:: and ($isInt, $isEven->not()),
			FilterNode:: and ($isArray, $isEmpty),
			FilterNode:: and ($isString, $isNumeric, $isOdd)
		)->not();
		$this->assertInstanceOf(AbstractNegatedFilter::class,$filter);
		$this->assertTrue($filter([04]));
		$this->assertFalse($filter([]));
		$this->assertTrue($filter(2));
		$this->assertTrue($filter("2"));
		$this->assertTrue($filter(""));
		$this->assertFalse($filter(1));
		$this->assertFalse($filter("1"));
		$this->assertFalse($filter("14353"));
		$this->assertFalse($filter("1.4"));
		$this->assertTrue($filter("2.4"));
		$this->assertTrue($filter("sdasd"));
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
	public function testAndOr_Not_Not($isInt, $isEven, $isArray, $isEmpty, $isString, $isNumeric, $isOdd)
	{
		$filter = FilterNode:: or (
			FilterNode:: and ($isInt, $isEven),
			FilterNode:: and ($isArray, $isEmpty),
			FilterNode:: and ($isString, $isNumeric, $isOdd)
		)->not()->not();
		$this->assertInstanceOf(AbstractOrFilter::class,$filter);
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