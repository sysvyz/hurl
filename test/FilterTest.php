<?php
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\Filters\Comparator\GreaterOrEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\GreaterThanFilter;
use Hurl\Node\Abstracts\Filters\Comparator\IsEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\IsNotEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\LessOrEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\LessThanFilter;
use Hurl\Node\Abstracts\Filters\IsArrayFilter;
use Hurl\Node\Abstracts\Filters\IsEmptyFilter;
use Hurl\Node\Abstracts\Filters\IsStringFilter;
use Hurl\Node\Abstracts\Filters\Logic\AndFilter;
use Hurl\Node\Abstracts\Filters\Logic\NegatedFilter;
use Hurl\Node\Abstracts\Filters\Logic\OrFilter;
use Hurl\Node\Abstracts\Filters\Number\IsEvenFilter;
use Hurl\Node\Abstracts\Filters\Number\IsIntegerFilter;
use Hurl\Node\Abstracts\Filters\Number\IsNumericFilter;
use Hurl\Node\Abstracts\Filters\Number\IsOddFilter;
use Hurl\Node\Interfaces\FilterInterface;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_Filter;

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
		$isNumeric = _Filter::isNumeric();
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
		$filter = _Filter::isGreaterThan(5);
		$this->assertInstanceOf(GreaterThanFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testGreaterThan_Not()
	{
		$filter = _Filter::isGreaterThan(5)->not();
		$this->assertInstanceOf(LessOrEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testGreaterThan_Not_Not()
	{
		$filter = _Filter::isGreaterThan(5)->not()->not();
		$this->assertInstanceOf(GreaterThanFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return GreaterOrEqualFilter
	 */
	public function testGreaterOrEqual()
	{
		$filter = _Filter::isGreaterOrEqual(5);
		$this->assertInstanceOf(GreaterOrEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return LessThanFilter
	 */
	public function testGreaterOrEqual_Not()
	{
		$filter = _Filter::isGreaterOrEqual(5)->not();
		$this->assertInstanceOf(LessThanFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testGreaterOrEqual_Not_Not()
	{
		$filter = _Filter::isGreaterOrEqual(5)->not()->not();
		$this->assertInstanceOf(GreaterOrEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testLessThan()
	{
		$filter = _Filter::isLessThan(5);
		$this->assertInstanceOf(LessThanFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testLessThan_Not()
	{
		$filter = _Filter::isLessThan(5)->not();
		$this->assertInstanceOf(GreaterOrEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testLessThan_Not_Not()
	{
		$filter = _Filter::isLessThan(5)->not()->not();
		$this->assertInstanceOf(LessThanFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testLessOrEqual()
	{
		$filter = _Filter::isLessOrEqual(5);
		$this->assertInstanceOf(LessOrEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testLessOrEqual_Not()
	{
		$filter = _Filter::isLessOrEqual(5)->not();
		$this->assertInstanceOf(GreaterThanFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testLessOrEqual_Not_Not()
	{
		$filter = _Filter::isLessOrEqual(5)->not()->not();
		$this->assertInstanceOf(LessOrEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testIsEqual()
	{
		$filter = _Filter::isEqual(5);
		$this->assertInstanceOf(IsEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testIsEqual_Not()
	{
		$filter = _Filter::isEqual(5)->not();
		$this->assertInstanceOf(IsNotEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testIsEqual_Not_Not()
	{
		$filter = _Filter::isEqual(5)->not()->not();
		$this->assertInstanceOf(IsEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	public function testIsNotEqual()
	{
		$filter = _Filter::isNotEqual(5);
		$this->assertInstanceOf(IsNotEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	public function testIsNotEqual_Not()
	{
		$filter = _Filter::isNotEqual(5)->not();
		$this->assertInstanceOf(IsEqualFilter::class, $filter);
		$this->assertFalse($filter(2));
		$this->assertTrue($filter(5));
		$this->assertFalse($filter(6));
		return $filter;
	}

	/**
	 * @return NegatedFilter
	 */
	public function testIsNotEqual_Not_Not()
	{
		$filter = _Filter::isNotEqual(5)->not()->not();
		$this->assertInstanceOf(IsNotEqualFilter::class, $filter);
		$this->assertTrue($filter(2));
		$this->assertFalse($filter(5));
		$this->assertTrue($filter(6));
		return $filter;
	}

	/**
	 * @return NegatedFilter
	 */
	public function testIsNotNumeric()
	{
		$isNotNumeric = _Filter::isNumeric()->not();
		$this->assertInstanceOf(NegatedFilter::class, $isNotNumeric);
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
	 * @return IsNumericFilter
	 */
	public function testIsNotNumeric_Not()
	{
		$isNotNumeric = _Filter::isNumeric()->not()->not();
		$this->assertInstanceOf(IsNumericFilter::class, $isNotNumeric);
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
	 * @return IsStringFilter
	 */
	public function testIsString()
	{
		$isString = _Filter::isString();
		$this->assertInstanceOf(IsStringFilter::class, $isString);
		$this->assertFalse($isString(2));
		$this->assertTrue($isString("2"));
		$this->assertTrue($isString("dfsdgfd"));
		$this->assertTrue($isString(""));
		$this->assertFalse($isString([]));
		return $isString;
	}

	/**
	 * @return IsArrayFilter
	 */
	public function testIsArray()
	{
		$isArray = _Filter::isArray();
		$this->assertInstanceOf(IsArrayFilter::class, $isArray);

		$this->assertTrue($isArray([04]));
		$this->assertTrue($isArray([]));
		$this->assertFalse($isArray("a"));
		return $isArray;
	}

	/**
	 * @return _Filter
	 */
	public function testIsEmpty()
	{
		$isEmpty = _Filter::isEmpty();
		$this->assertInstanceOf(IsEmptyFilter::class, $isEmpty);

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
	 * @return IsIntegerFilter
	 */
	public function testIsInt()
	{
		$isInt = _Filter::isInt();
		$this->assertInstanceOf(IsIntegerFilter::class, $isInt);

		$this->assertTrue($isInt(3));
		$this->assertFalse($isInt([]));
		$this->assertFalse($isInt(2.));
		$this->assertFalse($isInt(.2));
		$this->assertFalse($isInt("a"));
		return $isInt;
	}

	/**
	 * @return IsEvenFilter
	 */
	public function testIsEven()
	{
		$isEven = _Filter::isEven();
		$this->assertInstanceOf(IsEvenFilter::class, $isEven);

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
	 * @return IsOddFilter
	 */
	public function testIsOdd()
	{
		$isOdd = _Filter::isOdd();
		$this->assertInstanceOf(IsOddFilter::class, $isOdd);


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
	 * @param IsOddFilter $isOdd
	 * @return IsOddFilter
	 */
	public function testIsOdd_Not_IsEven_Not(IsOddFilter $isOdd)
	{
		$even = $isOdd->not();
		$this->assertInstanceOf(IsEvenFilter::class, $even);
		$odd = $even->not();
		$this->assertInstanceOf(IsOddFilter::class, $odd);
		return $isOdd;
	}

	/**
	 * @depends testIsArray
	 * @depends testIsEmpty
	 * @param $isArray
	 * @param $isEmpty
	 * @return \Hurl\Node\Abstracts\AbstractNode
	 */
	public function testAnd(IsArrayFilter $isArray, IsEmptyFilter $isEmpty)
	{
		$and = _Filter:: and ($isArray, $isEmpty);
		$this->assertInstanceOf(AndFilter::class, $and);

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

		$and = _Filter:: and ($isInt, $isEven);
		$this->assertInstanceOf(AndFilter::class, $and);

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
	public function testNand(IsIntegerFilter $isInt, IsEvenFilter $isEven)
	{

		$nand = _Filter:: and ($isInt, $isEven)->not();
		$this->assertInstanceOf(NegatedFilter::class, $nand);

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
	public function testOr(IsIntegerFilter $isInt, IsEmptyFilter $isEmpty)
	{
		$filter = _Filter:: or ($isInt, $isEmpty);
		$this->assertInstanceOf(OrFilter::class, $filter);
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
	public function testAndOr(IsIntegerFilter $isInt,
							  IsEvenFilter $isEven,
							  IsArrayFilter $isArray,
							  IsEmptyFilter $isEmpty,
							  IsStringFilter $isString,
							  IsNumericFilter $isNumeric,
							  IsOddFilter $isOdd
	)
	{
		$filter = _Filter:: or (
			_Filter:: and ($isInt, $isEven),
			_Filter:: and ($isArray, $isEmpty),
			_Filter:: and ($isString, $isNumeric, $isOdd)
		);
		$this->assertInstanceOf(OrFilter::class, $filter);
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
		$arrayfilter = _Array::filter($filter)->values();

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
		FilterInterface $isInt,
		FilterInterface $isEven,
		FilterInterface $isArray,
		FilterInterface $isEmpty,
		FilterInterface $isString,
		FilterInterface $isNumeric,
		FilterInterface $isOdd
	)
	{
		$filter = _Filter:: or (
			_Filter:: and ($isInt, $isEven->not()),
			_Filter:: and ($isArray, $isEmpty),
			_Filter:: and ($isString, $isNumeric, $isOdd)
		)->not();
		$this->assertInstanceOf(NegatedFilter::class, $filter);
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
	 * @return AbstractNode
	 */
	public function testAndOr_Not_Not($isInt, $isEven, $isArray, $isEmpty, $isString, $isNumeric, $isOdd)
	{
		$filter = _Filter:: or (
			_Filter:: and ($isInt, $isEven),
			_Filter:: and ($isArray, $isEmpty),
			_Filter:: and ($isString, $isNumeric, $isOdd)
		)->not()->not();
		$this->assertInstanceOf(OrFilter::class, $filter);
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