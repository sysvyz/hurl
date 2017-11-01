<?php
namespace HurlTest;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Arrays\StringExplode;
use Hurl\Node\Strings\ArrayImplode;
use Hurl\Node\Strings\StringLeftTrim;
use Hurl\Node\Strings\StringLowerCase;
use Hurl\Node\Strings\StringLowerCaseFirst;
use Hurl\Node\Strings\StringRightTrim;
use Hurl\Node\Strings\StringUpperCase;
use Hurl\Node\Strings\StringUpperCaseFirst;
use Hurl\Node\Statics\Strings;
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
		$implode = \Hurl\Node\Statics\Arrays::implode('.');
		$data = ['a', 'b', 'c'];
		$this->assertInstanceOf(ArrayImplode::class, $implode);
		$this->assertEquals('a.b.c', $implode($data));
	}

	public function testExplode()
	{
		$explode = Strings::explode('.');
		$data = 'a.b.c';
		$this->assertInstanceOf(StringExplode::class, $explode);
		$this->assertInstanceOf(AbstractArray::class, $explode);
		$this->assertEquals(['a', 'b', 'c'], $explode($data));
	}

	public function testLowerCase()
	{
		$lowerCase = Strings::lower_case();
		$data = 'aGasG4';
		$this->assertInstanceOf(StringLowerCase::class, $lowerCase);
		$this->assertInstanceOf(AbstractStringNode::class, $lowerCase);
		$this->assertEquals('agasg4', $lowerCase($data));
	}

	public function testUppercase()
	{
		$upperCase = Strings::upper_case();
		$data = 'agasg4';
		$this->assertInstanceOf(StringUpperCase::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('AGASG4', $upperCase($data));
	}
	public function testUpperCaseFirst()
	{
		$upperCase = Strings::ucfirst();
		$data = 'agasg4';
		$this->assertInstanceOf(StringUpperCaseFirst::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('Agasg4', $upperCase($data));
	}
	public function testLowerCaseFirst()
	{
		$upperCase = Strings::lcfirst();
		$data = 'AGAsg4';
		$this->assertInstanceOf(StringLowerCaseFirst::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('aGAsg4', $upperCase($data));
	}
	public function testLeftTrim()
	{
		$upperCase = Strings::ltrim();
		$data = '          AGA sg4             ';
		$this->assertInstanceOf(StringLeftTrim::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('AGA sg4             ', $upperCase($data));
	}
	public function testRightTrim()
	{
		$upperCase = Strings::rtrim();
		$data = '          AGA sg4             ';
		$this->assertInstanceOf(StringRightTrim::class, $upperCase);
		$this->assertInstanceOf(AbstractStringNode::class, $upperCase);
		$this->assertEquals('          AGA sg4', $upperCase($data));
	}

}