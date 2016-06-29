<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Abstracts\Comparator\BooleanComparator;
use Hurl\Node\Abstracts\Comparator\NumericComparator;
use Hurl\Node\Abstracts\Comparator\StringComparator;
use Hurl\Node\Abstracts\Comparator\StringLengthComparator;

final class _Comparator
{
	/**
	 * _Comparator constructor.
	 * @codeCoverageIgnore
	 */
	private final function __construct()
	{
	}

	/**
	 * @return AbstractComparator
	 */
	public static function numeric()
	{
		return new class() extends NumericComparator
		{
		};
	}

	/**
	 * @return StringComparator
	 */
	public static function alphaNumeric()
	{
		return new class() extends StringComparator
		{
		};
	}

	/**
	 * @return AbstractComparator
	 */
	public static function stringLength()
	{
		return new class() extends StringLengthComparator
		{
		};
	}

	/**
	 * @return AbstractComparator
	 */
	public static function boolean()
	{
		return new class() extends BooleanComparator
		{
		};
	}

}
