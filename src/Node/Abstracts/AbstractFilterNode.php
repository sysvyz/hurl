<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 21:39
 */

namespace Hurl\Node\Abstracts;


abstract class AbstractFilterNode extends AbstractNode
{
	/**
	 * @param callable $callable
	 * @return AbstractArrayNode
	 */
	public function not()
	{
		return $this->call(function ($e){return !$e;});
	}
}