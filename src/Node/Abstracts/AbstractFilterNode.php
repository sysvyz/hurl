<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 21:39
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\Container\ContainerTrait;
use Hurl\Node\Container\ContainerTraitInterface;
use Type\AbstractNegatedFilter;

abstract class AbstractFilterNode extends AbstractNode
{


	/**
	 * @param callable $do
	 * @return AbstractFilterNode
	 */
	public function call(callable $do)
	{
		return new class($this,$do) extends AbstractFilterNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractNegatedFilter|ContainerTraitInterface
	 */
	public function not()
	{
		$do = function ($e){return !$e;};
		return new class($this,$do) extends AbstractNegatedFilter implements ContainerTraitInterface
		{
			use ContainerTrait;

			public function not()
			{
				return $this->getBefore();
			}

		};
	}
}