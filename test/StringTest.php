<?php
namespace HurlTest;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Abstracts\Arrays\StringExplode;
use Hurl\Node\Abstracts\Strings\ArrayImplode;
use Hurl\Node\Abstracts\Strings\StringLowerCase;
use Hurl\Node\Abstracts\Strings\StringUpperCase;
use PHPUnit_Framework_TestCase;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 13:16
 */
class StringTest extends PHPUnit_Framework_TestCase
{


	public function testImplode()
	{
		$implode = \Hurl\Node\Statics\_Array::implode('.');
		$data = ['a', 'b', 'c'];
		$this->assertInstanceOf(ArrayImplode::class, $implode);
		$this->assertEquals('a.b.c', $implode($data));
	}

	public function testExplode()
	{
		$explode = \Hurl\Node\Statics\_String::explode('.');
		$data = 'a.b.c';
		$this->assertInstanceOf(StringExplode::class, $explode);
		$this->assertInstanceOf(AbstractArray::class, $explode);
		$this->assertEquals(['a', 'b', 'c'], $explode($data));
	}

	public function testLowerCase()
	{
		$lowerCase = \Hurl\Node\Statics\_String::lower_case();
		$data = 'aGasG4';
		$this->assertInstanceOf(StringLowerCase::class, $lowerCase);
		$this->assertInstanceOf(AbstractStringNode::class, $lowerCase);
		$this->assertEquals('agasg4', $lowerCase($data));
	}

	public function testUppercase()
	{
		$upperCase = \Hurl\Node\Statics\_String::upper_case();
		$data = 'agasg4';
		$this->assertInstanceOf(StringUpperCase::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('AGASG4', $upperCase($data));
	}

}