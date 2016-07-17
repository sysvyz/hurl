<?php
namespace HurlTest;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Hurl\Node\Abstracts\Comparator\ArrayComparator;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_Comparator;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:59
 */
class ArrayComparatorTest extends \PHPUnit_Framework_TestCase
{

	public function testComparator()
	{
		$cmp = ArrayComparator::init([
			'score' => 'desc',
			'first_name' => _Comparator::alphaNumeric(),
			'id',
		]);

		$data = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 56,
				'first_name' => 'dsf',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			]

		];
		$result = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			],
			[
				'score' => '56',
				'first_name' => 'dsf',
				'id' => 3
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparator2()
	{
		$cmp = new ArrayComparator([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name' => 'strcmp',
			'id',
		]);

		$data = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 56,
				'first_name' => 'dsf',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			]

		];
		$result = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			],
			[
				'score' => '56',
				'first_name' => 'dsf',
				'id' => 3
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparator3()
	{
		$cmp = new ArrayComparator([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name',
			'id' => 'asc',
		]);

		$data = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 56,
				'first_name' => 'dsf',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			]

		];
		$result = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			],
			[
				'score' => '56',
				'first_name' => 'dsf',
				'id' => 3
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparatorInvert()
	{
		$cmp = ArrayComparator::init([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name',
			'id' => 'asc',
		])->invert();

		$data = [
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 56,
				'first_name' => 'dsf',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			]

		];
		$result = [
			[
				'score' => '56',
				'first_name' => 'dsf',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'xxx',
				'id' => 4
			],
			[
				'score' => 99,
				'first_name' => 'fgh',
				'id' => 2
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 5
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 3
			],
			[
				'score' => 99,
				'first_name' => 'asc',
				'id' => 1
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	public function testComparatorMap()
	{
		$cmp = ArrayComparator::init([
			'score' => function ($a, $b) {
				return $b - $a;
			},
			'first_name',
			'id' => 'asc',
		])->map(function ($elem) {
			return $elem['item'];
		});

		$data = [
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]
			],
			[
				'item' => [
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]
			]

		];
		$result = [
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4

				]
			],
			[
				'item' => [
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}
	public function testComparatorRecursive()
	{
		$cmp = ArrayComparator::init([
			'item' => ArrayComparator::init([
				'score' => function ($a, $b) {
					return $b - $a;
				},
				'first_name',
				'id' => 'asc',
			])
		]);

		$data = [
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]
			],
			[
				'item' => [
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4
				]
			]

		];
		$result = [
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 1
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 3
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'asc',
					'id' => 5
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'fgh',
					'id' => 2
				]
			],
			[
				'item' => [
					'score' => 99,
					'first_name' => 'xxx',
					'id' => 4

				]
			],
			[
				'item' => [
					'score' => 56,
					'first_name' => 'dsf',
					'id' => 3
				]
			]

		];

		$sort = _Array::sort($cmp);
		$this->assertEquals($result, $sort($data));

	}

	/**
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage invalid func
	 */
	public function testComparatorFail()
	{
		$cmp = new ArrayComparator([
			'score' => 'asdfsfdljk',
			'id' => 'asc',
		]);

		$data = [
			['score' => 99, 'id' => 5],
			['score' => 56, 'id' => 3],
		];
		$sort = _Array::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail2()
	{
		$cmp = new ArrayComparator([
			'someKey',
			'id',
		]);

		$data = [
			['score' => 99, 'id' => 5],
			['score' => 56, 'id' => 3],
		];
		$sort = _Array::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail3()
	{
		$cmp = new ArrayComparator([
			'someKey',
			'id',
		]);

		$data = [
			['someKey' => 99, 'id' => 5],
			['score' => 56, 'id' => 3],
		];
		$sort = _Array::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        \Hurl\Node\Exceptions\UndefinedPropertyException
	 * @expectedExceptionMessage Undefined index: someKey
	 */
	public function testComparatorFail4()
	{
		$cmp = new ArrayComparator([
			'someKey',
			'id',
		]);

		$data = [
			['score' => 56, 'id' => 3],
			['someKey' => 99, 'id' => 5],
		];
		$sort = _Array::sort($cmp);
		$sort($data);

	}

	/**
	 * @expectedException        InvalidArgumentException
	 * @expectedExceptionMessage invalid property
	 */
	public function testComparatorFail5()
	{
		$cmp = new ArrayComparator([
			'score',
			'id',
		]);

		$data = [
			['score' => ['asa'], 'id' => 5],
			['score' => ['assa'], 'id' => 3],
		];
		$sort = _Array::sort($cmp);
		$sort($data);

	}
}

