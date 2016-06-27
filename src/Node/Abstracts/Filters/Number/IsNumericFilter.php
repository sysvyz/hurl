<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:45
 */

namespace Hurl\Node\Abstracts\Filters\Number;


use Hurl\Node\Abstracts\AbstractFilterNode;

abstract class IsNumericFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_numeric($value);
	}
}
