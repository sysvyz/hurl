<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:47
 */

namespace Hurl\Node\Abstracts\Filters\Number;


use Hurl\Node\Abstracts\AbstractFilterNode;

abstract class IsIntegerFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_int($value);
	}
}
