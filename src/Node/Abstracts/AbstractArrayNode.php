<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:01
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\ArrayNode;
use Hurl\Node\Math\MathNode;
use Hurl\Node\NodeContainer;

abstract class AbstractArrayNode extends AbstractNode
{


	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do)
	{
		return new class($this,$do) extends AbstractArrayNode
		{
			use NodeContainer;
		};
	}

	/**
	 * @param callable $do
	 * @return AbstractArrayNode
	 */
	public function each(callable $do)
	{
		return $this->call(ArrayNode::each($do));
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayNode
	 */
	public function map(callable $callable)
	{
		return $this->call(ArrayNode::map($callable));
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayNode
	 */
	public function sort(callable $callable)
	{
		return $this->call(ArrayNode::sort($callable));
	}

	/**
	 * @return AbstractNode
	 */
	public function sum()
	{
		return $this->call(MathNode::sum());
	}

}