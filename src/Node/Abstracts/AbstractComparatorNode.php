<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 23:57
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\ComparatorInterface;
use Hurl\Node\NodeContainer;

abstract class AbstractComparatorNode implements ComparatorInterface
{

	private $isInvert = 1;
	/**
	 * @var callable
	 */
	private $callable = null;

	/**
	 * @return AbstractComparatorNode
	 */

	public function invert()
	{
		$this->isInvert *= -1;
		return $this;
	}

	/**
	 * @param callable $callable
	 * @return $this
	 */
	public function map(callable $callable)
	{
		$this->callable = $callable;
		return $this;
	}

	public function __invoke(...$data)
	{

		if($this->callable){
			$f = $this->callable;
			return $this->isInvert * $this->compare($f($data[0]), $f($data[1]));
		}

		return $this->isInvert * $this->compare($data[0], $data[1]);

	}
}