<?php
use Hurl\Node\Statics\_Array;
use Hurl\Node\Statics\_String;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 04:44
 */
class AbstractNodeTest extends PHPUnit_Framework_TestCase
{


	public function testToJson()
	{
		$data = [4, 78, 2, 7, 4, 34, 43, 34];

		$toJson = _Array::values()->toJson();

		$json = $toJson($data);

		$this->assertEquals($json, '[4,78,2,7,4,34,43,34]');
	}

	public function testFromJson()
	{
		$data = '[4,78,2,7,4,34,43,34]';


		$fromJson = _String::trim()->fromJson();

		$array = $fromJson($data);
		$this->assertEquals($array, [4, 78, 2, 7, 4, 34, 43, 34]);
	}

	public function testExplode()
	{
		$data = '4,78,2,7,4,34,43,34';


		$explode = _String::trim()->explode(',');

		$array = $explode($data);
		$this->assertEquals($array, [4, 78, 2, 7, 4, 34, 43, 34]);
		return $array;
	}

	public function testAsClosure()
	{
		$data = '4,78,2,7,4,34,43,34';


		$explode = _String::trim()->explode(',')->asClosure();


		$this->assertInstanceOf(Closure::class, $explode);
		$this->assertNotInstanceOf(\Hurl\Node\Abstracts\AbstractNode::class, $explode);

		$array = $explode($data);
		$this->assertEquals($array, [4, 78, 2, 7, 4, 34, 43, 34]);


		return $array;
	}

	/**
	 * @depends testExplode
	 * @param $data
	 */
	public function testDebug($data)
	{


		$debug = _Array::values()->debug();


		$expected = 'Array
(
    [0] => 4
    [1] => 78
    [2] => 2
    [3] => 7
    [4] => 4
    [5] => 34
    [6] => 43
    [7] => 34
)
';
		ob_start();
		$array = $debug($data);
		$result = ob_get_clean();

		$this->assertEquals($expected, $result);
		$this->assertEquals($array, [4, 78, 2, 7, 4, 34, 43, 34]);
	}


}