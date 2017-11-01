<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:47
 */

namespace Hurl\Node\Filters;


use Hurl\Node\Abstracts\AbstractFilter;

abstract class IsArrayFilter extends AbstractFilter
{
	public function apply($value)
	{
		return is_array($value);
	}
}
