<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:44
 */

namespace Hurl\Node\Abstracts\Filters;


use Hurl\Node\Abstracts\AbstractFilterNode;

abstract class IsStringFilter extends AbstractFilterNode
{
	public function apply($value)
	{
		return is_string($value);
	}
}