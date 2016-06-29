<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Interfaces\CollectionNodeInterface;

class _String
{


	/**
	 * @return AbstractStringNode
	 */
	public static function trim()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return trim($data[0]);
			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function ltrim()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return ltrim($data[0]);

			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function rtrim()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return rtrim($data[0]);

			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function ucfirst()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return ucfirst($data[0]);

			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function lcfirst()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return lcfirst($data[0]);

			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function upper_case()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return strtoupper($data[0]);

			}
		};
	}

	/**
	 * @return AbstractStringNode
	 */
	public static function lower_case()
	{
		return new class() extends AbstractStringNode
		{
			public function __invoke(...$data)
			{
				return strtolower($data[0]);
			}
		};
	}

	public static function implode($glue)
	{
		return _Array::implode($glue);
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
		return new class($start, $length) extends AbstractStringNode
		{
			private $start;
			private $length;

			/**
			 *  constructor.
			 * @param $start
			 * @param $length
			 */
			public function __construct($start, $length)
			{
				$this->start = $start;
				$this->length = $length;
			}

			public function __invoke(...$data)
			{
				return substr($data[0], $this->start, $this->length);
			}
		};
	}
}