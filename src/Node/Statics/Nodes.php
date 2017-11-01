<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 04:09
 */

namespace Hurl\Node\Statics;


use Hurl\Node\Abstracts\AbstractNode;

final class Nodes
{
	/**
	 * _Node constructor.
	 * @codeCoverageIgnore
	 */
	private final function __construct()
	{
	}


	/**
	 * @return AbstractNode
	 */
	public static function init(callable $callable)
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


}