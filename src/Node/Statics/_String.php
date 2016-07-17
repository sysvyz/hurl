<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Abstracts\Strings\StringLeftTrim;
use Hurl\Node\Abstracts\Strings\StringLowerCase;
use Hurl\Node\Abstracts\Strings\StringLowerCaseFirst;
use Hurl\Node\Abstracts\Strings\StringRightTrim;
use Hurl\Node\Abstracts\Strings\StringSubstring;
use Hurl\Node\Abstracts\Strings\StringTrim;
use Hurl\Node\Abstracts\Strings\StringUpperCase;
use Hurl\Node\Abstracts\Strings\StringUpperCaseFirst;
use Hurl\Node\Interfaces\CollectionNodeInterface;

final class _String
{
	/**
	 * _String constructor.
	 * @codeCoverageIgnore
	 */
	private final function __construct()
	{
	}


	/**
	 * @return AbstractStringNode
	 */
	public static function trim()
	{
		return new class() extends StringTrim
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function ltrim()
	{
		return new class() extends StringLeftTrim
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function rtrim()
	{
		return new class() extends StringRightTrim
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function ucfirst()
	{
		return new class() extends StringUpperCaseFirst
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function lcfirst()
	{
		return new class() extends StringLowerCaseFirst
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function upper_case()
	{
		return new class() extends StringUpperCase
		{
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function lower_case()
	{
		return new class() extends StringLowerCase
		{
		};
	}


	/**
	 * @param $delimiter
	 * @return CollectionNodeInterface
	 */
	public static function explode($delimiter)
	{
		return _Array::explode($delimiter);
	}


	/**
	 * @param $glue
	 * @return AbstractStringNode
	 */
	public static function substring($start, $length = null)
	{
		return new class($start, $length) extends StringSubstring
		{
		};
	}
}