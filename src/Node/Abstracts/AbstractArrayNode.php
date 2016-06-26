<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:01
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\ArrayNode;
use Hurl\Node\Container\ContainerTrait;
use Hurl\Node\Math\MathNode;
use Type\AbstractArrayEach;
use Type\AbstractArrayMap;
use Type\AbstractArrayMerge;
use Type\AbstractArraySort;

abstract class AbstractArrayNode extends AbstractNode
{


	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do)
	{
		return new class($this, $do) extends AbstractArrayNode
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $do
	 * @return AbstractArrayEach
	 */
	public function each(callable $do)
	{
		return new class($this, ArrayNode::each($do)) extends AbstractArrayEach
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayMap
	 */
	public function map(callable $callable)
	{
		return new class($this, ArrayNode::map($callable)) extends AbstractArrayMap
		{
			use ContainerTrait;
		};

	}

	/**
	 * @param \callable[] ...$callable
	 * @return AbstractArraySort
	 */
	public function sort(callable ...$callable)
	{
		return new class($this, ArrayNode::sort(...$callable)) extends AbstractArraySort
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param \callable[] ...$callable
	 * @return AbstractArraySort
	 */
	public function merge()
	{
		return new class($this, ArrayNode::merge()) extends AbstractArrayMerge
		{
			use ContainerTrait;
		};
	}

	/**
	 * @return AbstractNode
	 */
	public function sum()
	{
		return new class($this, MathNode::sum()) extends AbstractNode
		{
			use ContainerTrait;
		};
	}

	public function values()
	{
		return new class($this, ArrayNode::values()) extends AbstractArrayNode
		{
			use ContainerTrait;
		};
	}

}