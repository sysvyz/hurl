<?php
namespace HurlTest;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Hurl\GenericObject;
use Hurl\Node\Comparator\ObjectComparator;
use Hurl\Node\Statics\Arrays;
use Hurl\Node\Statics\Comparators;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:59
 */
class ObjectComparatorTest extends \PHPUnit_Framework_TestCase
{

	public function testComparator()
	{
		$cmp = ObjectComparator::init([
			'score' => 'desc',
			'first_name' => Comparators::alphaNumeric(),
			'id',
		]);

		$data = [

			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]),
			GenericObject::init(

				[
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]),
			GenericObject::init(

				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]),
			GenericObject::init(

				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(

				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]),

		];
		$result = [
			GenericObject::init([
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]),
			GenericObject::init(
				[
					'score' => '56',
					'first_name' => 'dsf',
					'id' => 3
				])

		];

		$sort = Arrays::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparator2()
	{
		$cmp = new ObjectComparator([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name' => 'strcmp',
			'id',
		]);

		$data = [
			GenericObject::init([
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			]),
			GenericObject::init(
				[
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				])

		];
		$result = [
			GenericObject::init([
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]),
			GenericObject::init(
				[
					'score' => '56',
					'first_name' => 'dsf',
					'id' => 3
				])

		];

		$sort = Arrays::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparator3()
	{
		$cmp = new ObjectComparator([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name',
			'id' => 'asc',
		]);

		$data = [
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]),
			GenericObject::init(
				[
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				])

		];
		$result = [
			GenericObject::init([
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]),
			GenericObject::init(
				[
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]),
			GenericObject::init(
				[
					'score' => '56',
					'first_name' => 'dsf',
					'id' => 3
				])

		];

		$sort = Arrays::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	/**
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage invalid func
	 */
	public function testComparatorFail()
	{
		$cmp = new ObjectComparator([
			'score' => 'asdfsfdljk',
			'id' => 'asc',
		]);

		$data = [
			GenericObject::init(['score' => 99, 'id' => 5]),
			GenericObject::init(['score' => 56, 'id' => 3]),
		];
		$sort = Arrays::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail2()
	{
		$cmp = new ObjectComparator([
			'someKey',
			'id',
		]);

		$data = [
			GenericObject::init(['score' => 99, 'id' => 5]),
			GenericObject::init(['score' => 56, 'id' => 3]),
		];
		$sort = Arrays::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail3()
	{
		$cmp = new ObjectComparator([
			'someKey',
			'id',
		]);

		$data = [
			GenericObject::init(['score' => 99, 'id' => 5]),
			GenericObject::init(['score' => 56, 'id' => 3]),
		];
		$sort = Arrays::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail4()
	{
		$cmp = new ObjectComparator([
			'someKey',
			'id',
		]);

		$data = [
			GenericObject::init(['score' => 99, 'id' => 5]),
			GenericObject::init(['score' => 56, 'id' => 3]),
		];
		$sort = Arrays::sort($cmp);
		$sort($data);

	}
	/**
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage invalid property
	 */
	public function testComparatorFail5()
	{
		$cmp = new ObjectComparator([
			'score',
			'id',
		]);

		$data = [
			GenericObject::init(['score' =>['asa'], 'id' => 5]),
			GenericObject::init(['score' => ['assa'], 'id' => 3]),
		];
		$sort = Arrays::sort($cmp);
		$sort($data);

	}

}

