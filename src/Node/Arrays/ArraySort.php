<?php

namespace Hurl\Node\Arrays;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Interfaces\Traits\ArrayTraitInterface;
use Hurl\Node\Traits\ComparatorContainerTrait;
use Hurl\Node\Traits\ArrayTrait;

class ArraySort extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;
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
				$callable = new class($callable, $callables[$int]) extends AbstractComparator
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
