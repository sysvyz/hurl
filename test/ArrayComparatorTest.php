<?php
namespace HurlTest;

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
		$cmp = new ArrayComparator([
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
			'score' => function($a,$b){return $b-$a;},
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
			'score' => function($a,$b){return $b-$a;},
			'first_name',
			'id'=>'asc',
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

}