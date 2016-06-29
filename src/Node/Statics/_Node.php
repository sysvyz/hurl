<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractNode;

abstract class _Node
{
	private final function __construct()
	{
	}
//	public static function lcfirst()
//	{
//		return StringNode::lcfirst();
//	}
//
//	public static function ucfirst()
//	{
//		return StringNode::ucfirst();
//	}
//
//	public static function upper_case()
//	{
//		return StringNode::upper_case();
//	}
//
//	public static function lower_case()
//	{
//		return StringNode::lower_case();
//	}
//
//	public static function trim()
//	{
//		return StringNode::trim();
//	}
//
//	public static function ltrim()
//	{
//		return StringNode::ltrim();
//	}
//
//	public static function rtrim()
//	{
//		return StringNode::rtrim();
//	}

//	public static function substring($start, $length = null)
//	{
//		return StringNode::substring($start, $length);
//	}
//
//
//	public static function implode($glue)
//	{
//		return ArrayNode::implode($glue);
//	}
//
//	public static function explode($delimiter)
//	{
//		return ArrayNode::explode($delimiter);
//	}

//	public static function each(callable $do)
//	{
//		return ArrayNode::each($do);
//	}
//
//	public static function filter(callable $filter = null)
//	{
//		return ArrayNode::filter($filter);
//	}
//
//	public static function map(callable $mapping = null)
//	{
//		return ArrayNode::map($mapping);
//	}

	/**
	 * @return AbstractNode
	 */
	public static function call(callable $callable)
	{
		return new class($callable) extends AbstractNode
		{
			private $callable;

			public function __construct($callable)
			{
				$this->callable = $callable;
			}

			public function __invoke(...$data)
			{
				$callable = $this->callable;
				return $callable($data[0]);

			}
		};
	}

	/**
	 * @param $delimiter
	 * @return AbstractNode
	 */
	public static function debug()
	{
		return new class() extends AbstractNode
		{

			public function __invoke(...$data)
			{
				print_r($data[0]);
				return $data[0];
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function toJson()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return json_encode($data[0]);
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function fromJson()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return json_decode($data[0], true);

			}
		};
	}


//	public static function fold(callable $callable, $init = null)
//	{
//		return ArrayNode::fold($callable, $init);
//	}


}