<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 21:39
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\Abstracts\Filters\Logic\NegatedFilter;
use Hurl\Node\Interfaces\ContainerTraitInterface;
use Hurl\Node\Traits\ContainerTrait;


abstract class AbstractFilter extends AbstractNode
{


	/**
	 * @param callable $do
	 * @return AbstractFilter
	 */
	public function then(callable $do)
	{
		return new class($this, $do) extends AbstractFilter implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return NegatedFilter
	 */
	public function not()
	{
		return new class($this, function ($e) {
			return !$e;
		}) extends NegatedFilter implements ContainerTraitInterface
		{
			use ContainerTrait;

			public function not()
			{
				return $this->getBefore();
			}

		};
	}


}