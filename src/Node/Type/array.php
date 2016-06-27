<?php

namespace Type;

use Hurl\Node\Abstracts\AbstractArrayNode;
use Hurl\Node\Abstracts\AbstractComparatorNode;
use Hurl\Node\Interfaces\ArrayTraitInterface;
use Hurl\Node\Traits\ComparatorContainerTrait;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 22:25
 */
abstract class AbstractArraySort extends AbstractArrayNode implements ArrayTraitInterface
{
	/**
	 * @var callable
	 */
	private $callable;

	/**
	 *  constructor.
	 * @param $callable
	 */
	public function __construct(callable ...$callables)
	{
		$callable = $callables[0];
		if (count($callables) > 1) {
			for ($int = 1; $int < count($callables); $int++) {
				$callable = new class($callable, $callables[$int]) extends AbstractComparatorNode
				{
					use ComparatorContainerTrait;
				};
			}
		}
		$this->callable = $callable;

	}

	public function apply(...$data)
	{
		usort($data[0], $this->callable);
		return $data[0];
	}
}

abstract class AbstractArrayMap extends AbstractArrayNode implements ArrayTraitInterface
{	protected $mapping;

	public function __construct($mapping)
	{
		$this->mapping = $mapping;
	}

	public function apply(...$data)
	{
		return array_map($this->mapping, ...$data);
	}
}

abstract class AbstractArrayMerge extends AbstractArrayNode implements ArrayTraitInterface
{
	public function apply(...$data)
	{
		return array_merge(...$data);
	}
}

abstract class AbstractArrayFold extends AbstractArrayNode implements ArrayTraitInterface
{
	/**
	 * @var callable
	 */
	private $callable;
	/**
	 * @var
	 */
	private $init;

	/**
	 *  constructor.
	 * @param $callable
	 * @param $init
	 */
	public function __construct(callable $callable, $init)
	{
		$this->callable = $callable;
		$this->init = $init;
	}

	public function apply(...$data)
	{
		return array_reduce($data[0], $this->callable, $this->init);

	}
}

abstract class AbstractArrayFilter extends AbstractArrayNode implements ArrayTraitInterface
{	/**
 * @var callable
 */
	protected $callable;


	/**
	 *  constructor.
	 * @param $callable
	 */
	public function __construct(callable $callable = null)
	{
		$this->callable = $callable;
	}

	public function apply(...$data)
	{
//var_dump($this->callable);die;

		if ($this->callable) {
			return array_filter($data[0], $this->callable);
		}
		return array_filter($data[0]);
	}
}

abstract class AbstractArrayValues extends AbstractArrayNode implements ArrayTraitInterface
{
	public function apply(...$data)
	{
		return array_merge(...$data);
	}

}

abstract class AbstractArrayEach extends AbstractArrayNode implements ArrayTraitInterface
{
	private $do;

	public function __construct($do)
	{
		$this->do = $do;
	}

	public function apply(...$data)
	{
		array_walk($data[0], $this->do);
		return $data;
	}
}