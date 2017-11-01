<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:47
 */

namespace Hurl\Node\Filters\Number;


use Hurl\Node\Abstracts\AbstractFilter;

abstract class IsIntegerFilter extends AbstractFilter
{
	public function apply($value)
	{
		return is_int($value);
	}
}
