<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\AbstractArrayNode;
use Hurl\Node\Abstracts\AbstractStringNode;

class StringNode
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
		return ArrayNode::implode($glue);
	}

	public static function explode($delimiter)
	{
		return new class($delimiter) extends AbstractArrayNode
		{
			private $delimiter;

			public function __construct($delimiter)
			{
				$this->delimiter = $delimiter;
			}

			public function __invoke(...$data)
			{
				return explode($this->delimiter, $data[0]);

			}
		};

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