<?php
namespace HurlTest;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Abstracts\Arrays\StringExplode;
use Hurl\Node\Abstracts\Strings\ArrayImplode;
use Hurl\Node\Abstracts\Strings\StringLeftTrim;
use Hurl\Node\Abstracts\Strings\StringLowerCase;
use Hurl\Node\Abstracts\Strings\StringLowerCaseFirst;
use Hurl\Node\Abstracts\Strings\StringRightTrim;
use Hurl\Node\Abstracts\Strings\StringUpperCase;
use Hurl\Node\Abstracts\Strings\StringUpperCaseFirst;
use Hurl\Node\Statics\_String;
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
		$explode = _String::explode('.');
		$data = 'a.b.c';
		$this->assertInstanceOf(StringExplode::class, $explode);
		$this->assertInstanceOf(AbstractArray::class, $explode);
		$this->assertEquals(['a', 'b', 'c'], $explode($data));
	}

	public function testLowerCase()
	{
		$lowerCase = _String::lower_case();
		$data = 'aGasG4';
		$this->assertInstanceOf(StringLowerCase::class, $lowerCase);
		$this->assertInstanceOf(AbstractStringNode::class, $lowerCase);
		$this->assertEquals('agasg4', $lowerCase($data));
	}

	public function testUppercase()
	{
		$upperCase = _String::upper_case();
		$data = 'agasg4';
		$this->assertInstanceOf(StringUpperCase::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('AGASG4', $upperCase($data));
	}
	public function testUpperCaseFirst()
	{
		$upperCase = _String::ucfirst();
		$data = 'agasg4';
		$this->assertInstanceOf(StringUpperCaseFirst::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('Agasg4', $upperCase($data));
	}
	public function testLowerCaseFirst()
	{
		$upperCase = _String::lcfirst();
		$data = 'AGAsg4';
		$this->assertInstanceOf(StringLowerCaseFirst::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('aGAsg4', $upperCase($data));
	}
	public function testLeftTrim()
	{
		$upperCase = _String::ltrim();
		$data = '          AGA sg4             ';
		$this->assertInstanceOf(StringLeftTrim::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('AGA sg4             ', $upperCase($data));
	}
	public function testRightTrim()
	{
		$upperCase = _String::rtrim();
		$data = '          AGA sg4             ';
		$this->assertInstanceOf(StringRightTrim::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('          AGA sg4', $upperCase($data));
	}

}