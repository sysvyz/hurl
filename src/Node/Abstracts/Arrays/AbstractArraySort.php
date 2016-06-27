<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:18
 */

namespace Hurl\Node\Abstracts\Arrays;
use Hurl\Node\Abstracts\AbstractArrayNode;
use Hurl\Node\Abstracts\AbstractComparatorNode;
use Hurl\Node\Interfaces\ArrayTraitInterface;
use Hurl\Node\Traits\ComparatorContainerTrait;

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
